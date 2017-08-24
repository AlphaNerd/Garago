angular.module('garago.controllers', [])

  .controller('ParentCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $ionicSlideBoxDelegate, $garagoAPI, $window, $ionicLoading) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      console.log("ParentCtrl Loaded.")
    });

    $scope.CurrentUser = Parse.User.current()
    //// logout current Parse User
    $scope.logout = function() {
      console.log("Logout User")
      Parse.User.logOut().then(function(res) {
        console.log("User logged out", res)
        $rootScope.CurrentUser = {}
        $state.go("login")
      })
    }

    $scope.createNewActionPlan = function() {
      $ionicLoading.show({
        template: '<i class="icon ion-loading-c"></i><div>Creating new Action Plan...</div>',
        duration: 1000
      })
      Parse.Cloud.run('createNewActionPlan', { 
        title: 'My New Action Plan',
        description: 'Some example description'
      }).then(function(res) {
        $ionicLoading.hide()
        console.log([res.attributes])
      });
    }

    $scope.MENU_ACTIONPLAN = [{
      name: "Action Plans",
      class: 'columns',
      items: [{
        title: "My Plans",
        link: "#/app/actionplans",
        class: "list"
      },{
        title: "Latest Plan",
        link: "#/app/actionplan/",
        class: "clock-o"
      }, {
        title: "Comment",
        link: "#/app/listplan/comments",
        class: "comments-o"
      }, {
        title: "Create New",
        link: "#/app/listplan/new",
        class: "plus"
      }]
    }, {
      name: "Forms",
      class: 'files-o',
      items: [{
        title: "Saved",
        link: "#/app/myforms",
        class: "floppy-o"
      }, {
        title: "Create",
        link: "#/app/newform",
        class: "plus"
      }]
    }, {
      name: "Reports",
      class: 'line-chart',
      items: [{
        title: "Charts",
        link: "#/app/myreports/charts",
        class: "pie-chart"
      }, {
        title: "Tables",
        link: "#/app/myreports/tables,",
        class: "signal"
      }, {
        title: "Custom",
        link: "#/app/myreports/custom,",
        class: "area-chart"
      }, {
        title: "Create New",
        link: "#/app/myreports/custom,",
        class: "plus"
      }]
    }, {
      name: "Projects",
      class: 'folder-o',
      items: [{
        title: "View All",
        link: "#/app/myreports/charts",
        class: "folder-open-o"
      }, {
        title: "Create new",
        link: "#/app/myreports/tables,",
        class: "plus"
      }]
    }];

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
