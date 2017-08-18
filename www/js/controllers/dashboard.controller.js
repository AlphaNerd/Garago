angular.module('garago.controllers.dashboard', [])

  .controller('DashboardCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $garagoAPI) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      console.log("DashboardCtrl Loaded.")
    });

    $timeout(function() {
      // $ionicSideMenuDelegate.canDragContent(false)
      if(!$rootScope.isMobile){
        $ionicSideMenuDelegate.toggleLeft()
      }
    }, 50)

    

  })
