angular.module('garago.controllers', [])

  .controller('ParentCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $ionicSlideBoxDelegate, $garagoAPI, $parseAPI, $window, $ionicLoading, $state, $ionicPopup, $ionicHistory, $translate) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      console.log("ParentCtrl Loaded.")
      var myDelay = 0;
      Parse.User.current().fetch()
    });

    $scope.handleParseError = function(err) {
      switch (err.code) {
        case Parse.Error.INVALID_SESSION_TOKEN:
          Parse.User.logOut();
          $state.go("login")
          break;
      }
    }
    ///// this needs to be finished - parse large db provided by client
    // $timeout(function(){
    //   Parse.Cloud.run('getNocCodes',{}).then(function(res) {
    //     console.info(res)
    //   });
    // },500)

    $scope.changeLanguage = function (langKey) {
      console.log("Change to ",langKey)
      if(langKey == 'English'){
        langKey = 'en'
      }else{
        langKey = 'fr'
      }
      console.log(langKey)
      $translate.use(langKey);
    };

    $rootScope.CurrentUser = Parse.User.current()
    //// logout current Parse User
    $scope.logout = function() {
      console.log("Logout User")
      var confirmPopup = $ionicPopup.confirm({
        title: "You're about to sign out!",
        template: "If this is what you really want to do, then click 'OK'. Press 'Cancel' to remain friends."
      });

      confirmPopup.then(function(res) {
        if (res) {
          console.log('You are sure');
          Parse.User.logOut().then(function(res) {
            console.log("User logged out", res)
            $rootScope.CurrentUser = {}
            $state.go("login")
          })
        } else {
          console.log('You are not sure');
        }
      });
    }

    $scope.editFile = function(fileid){
      console.log(fileid)
      $state.go("app.edit_file",{id:fileid})
    }

    $parseAPI.getUserMessages().then(function(res) {
      console.log("User Messages: ", [res])
      $scope.MESSAGES = res
    })

    $scope.createNewActionPlan = function() {
      $ionicLoading.show({
        template: '<i class="icon ion-loading-c"></i><div>Creating new Action Plan...</div>',
        duration: 1000
      })
      Parse.Cloud.run('createNewActionPlan', {
        title: 'My New Action Plan',
        description: 'Some example description'
      }).then(function(res) {
        $scope.DATA = res
        $ionicLoading.hide()
      });
    }

    $scope.entryDelay = function() {
      myDelay += 1
      return myDelay
    }

    $scope.MENU_ACTIONPLAN = [
      // {
      //   name: "Action Plans",
      //   class: 'columns',
      //   items: [{
      //     title: "My Plans",
      //     link: "#/app/actionplans",
      //     class: "list"
      //   },{
      //     title: "Latest Plan",
      //     link: "#/app/actionplan/",
      //     class: "clock-o"
      //   }, {
      //     title: "Create New",
      //     link: "#/app/actionplan/new",
      //     class: "plus"
      //   }]
      // },{
      //   name: "Projects",
      //   class: 'folder-o',
      //   items: [{
      //     title: "My Projects",
      //     link: "#/app/projects",
      //     class: "folder-open-o"
      //   }, {
      //     title: "Latest Project",
      //     link: "#/app/project/",
      //     class: "clock-o"
      //   }, {
      //     title: "Create new",
      //     link: "#/app/project/new,",
      //     class: "plus"
      //   }]
      // },{
      //   name: "Activities",
      //   class: 'folder-o',
      //   items: [{
      //     title: "My Activities",
      //     link: "#/app/activities",
      //     class: "folder-open-o"
      //   }, {
      //     title: "Latest Activity",
      //     link: "#/app/activity/",
      //     class: "clock-o"
      //   }, {
      //     title: "Create new",
      //     link: "#/app/activity/new",
      //     class: "plus"
      //   }]
      // },{
      //   name: "Forms",
      //   class: 'files-o',
      //   items: [{
      //     title: "My Forms",
      //     link: "#/app/myforms",
      //     class: "folder-open-o"
      //   },{
      //     title: "Form Builder",
      //     link: "#/app/formbuilder",
      //     class: "cogs"
      //   },{
      //     title: "Create Form",
      //     link: "#/app/newform",
      //     class: "plus"
      //   }]
      // }, {
      //   name: "Reports",
      //   class: 'line-chart',
      //   items: [{
      //     title: "Charts",
      //     link: "#/app/myreports/charts",
      //     class: "pie-chart"
      //   }, {
      //     title: "Tables",
      //     link: "#/app/myreports/tables,",
      //     class: "signal"
      //   }, {
      //     title: "Custom",
      //     link: "#/app/myreports/custom,",
      //     class: "area-chart"
      //   }, {
      //     title: "Create New",
      //     link: "#/app/myreports/custom,",
      //     class: "plus"
      //   }]
      // },
      {
        name: "SMART_LIBRARY",
        class: 'folder-o',
        items: [{
            title: "DASHBOARD",
            link: "#/app/library",
            class: "windows"
          }, {
            title: "MY_FAVORITES",
            link: "#/app/library/favs",
            class: "bookmark"
          }, {
            title: "BROWSE_ALL",
            link: "#/app/library/browse",
            class: "list"
          }
        ]
      },{
        name: "MANAGE_USERS",
        class: 'folder-o',
        items: [{
            title: "INVITE_USERS",
            link: "#/app/users/invite",
            class: "user"
          }, {
            title: "MANAGE_USERS",
            link: "#/app/users",
            class: "users"
          }, {
            title: "MANAGE_INVITES",
            link: "#/app/users/invites",
            class: "ticket"
          }
        ]
      }
    ];

    $scope.gotoSlide = function(num) {
      $ionicSlideBoxDelegate.slide(num, 500);
    }

    $scope.toggleGroup = function(group) {
      if ($scope.isGroupShown(group)) {
        $scope.shownGroup = null;
      } else {
        $scope.shownGroup = group;
      }
    };
    $scope.isGroupShown = function(group) {
      return $scope.shownGroup === group;
    };

    $scope.isActiveMenu = function(data) {
      if (data == $window.location.hash) {
        return true
      } else {
        return false
      }
    }

    $scope.getRandomUser = function() {
      $garagoAPI.getRandomUserImage().then(function(res) {
        console.log(res)
        return res
      })
    }

  })
