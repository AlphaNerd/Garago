angular.module('garago.controllers', [])

  .controller('ParentCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $garagoAPI) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      console.log("ParentCtrl Loaded.")
    });

    $scope.MENU_ACTIONPLAN = [{
      name: "Action Plans",
      items: [{
        title: "Latest Plan",
        link: "#/app/listplan",
        class: ""
      },{
        title: "New Plan",
        link: "#/app/listplan",
        class: ""
      }]
    }];
 
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

  })
