angular.module('garago.controllers', [])

  .controller('ParentCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $ionicSlideBoxDelegate, $garagoAPI, $parseAPI, $window, $ionicLoading, $state, $ionicPopup, $ionicHistory, $translate) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      // console.log("ParentCtrl Loaded.")
      var myDelay = 0;
      $rootScope.currentUser = Parse.User.current()
      // console.log($scope.currentUser)
    });

    $scope.handleParseError = function(err) {
      switch (err.code) {
        case Parse.Error.INVALID_SESSION_TOKEN:
          Parse.User.logOut();
          $state.go("login")
          break;
      }
    }


    ///// Language init()
    $translate.use(Parse.User.current().attributes.language);
    moment.locale(Parse.User.current().attributes.language)

    $scope.changeLanguage = function(langKey) {
      console.log("Change to ", langKey)
      if (langKey == 'English') {
        langKey = 'en'
        moment.locale(langKey)
        Parse.User.current().set("language", "en")
        Parse.User.current().save()
        console.log(langKey)
        $translate.use(langKey);
        Parse.User.current().fetch()
      } else {
        langKey = 'fr'
        moment.locale(langKey)
        Parse.User.current().set("language", "fr")
        Parse.User.current().save()
        console.log(langKey)
        $translate.use(langKey);
        Parse.User.current().fetch()
      }
    };

    $scope.rateFile = function($event, item) {
      console.log($event, item)
      var rating = $event.rating
      var rating_count = item.attributes.rating_count + 1
      var total_ratings = item.attributes.total_ratings + rating
      var average = total_ratings/rating_count
      item.set("rating",average)
      item.set("rating_count",rating_count)
      item.set("total_ratings",total_ratings)
      item.save().then(function(res){
        console.log("Saved: ",res)
      })
    }

    $rootScope.CurrentUser = Parse.User.current()
    //// logout current Parse User
    $scope.logout = function() {
      console.log("Logout User")
      var header = ''
      var message = ''
      $translate('ALERTS.SIGN_OUT_ALERT_HEADER').then(function(res) {
        header = res;
      }, function(translationId) {
        header = translationId;
      });
      $translate('ALERTS.SIGN_OUT_MESSAGE').then(function(res) {
        message = res;
        var confirmPopup = $ionicPopup.confirm({
          title: header,
          template: message
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
      }, function(translationId) {
        message = translationId;
      });

    }

    $scope.editFile = function(fileid) {
      console.log(fileid)
      $state.go("app.edit_file", { id: fileid })
    }

    // $parseAPI.getUserMessages().then(function(res) {
    //   console.log("User Messages: ", [res])
    //   $scope.MESSAGES = res
    // })

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
        admin: false,
        items: [{
          title: "DASHBOARD",
          link: "#/app/library",
          class: "windows"
        }, {
          title: "MY_FAVORITES",
          link: "#/app/library/favs",
          class: "star"
        }, {
          title: "MY_UPLOADS.HEADER",
          link: "#/app/library/myuploads",
          class: "list",
          admin:true
        }, {
          title: "BROWSE_ALL",
          link: "#/app/library/browse",
          class: "list"
        }]
      }, {
        name: "MANAGE_USERS",
        class: 'folder-o',
        admin: true,
        items: [{
          title: "INVITE_USERS",
          link: "#/app/users/invite",
          class: "user"
        }, {
          title: "MANAGE_USERS",
          link: "#/app/users",
          class: "users"
        }]
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
