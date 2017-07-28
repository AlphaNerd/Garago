angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate) {

  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  $scope.$on('$ionicView.enter', function(e) {
    console.log("AppCtrl Loaded.")
  });

  // $rootScope.isMobile = ionic.Platform.isIOS() || ionic.Platform.isAndroid();
  // if ($rootScope.isMobile) {
  //   console.log("Device is Mobile")
  // } else {
  //   console.log("Device is NOT Mobile")
  //   $timeout(function() {
  //     $ionicSideMenuDelegate.toggleLeft(true)
  //   }, 50)
  // }

  /// Check active menu item
  $scope.isItemActive = function(item) {
    return false
  };

  $scope.reportTitle = "Title Goes Here"

  $scope.DATA = [{
    title: "Example",
    metrics: [{
      text: "Something",
    }],
    style: {
      'background': Please.make_color(),
      'color': '#fff'
    }
  }, {
    title: "Example 2",
    metrics: [{
      text: "Something",
      style: {
        'width':'100%'
      }
    }],
    style: {
      'background': Please.make_color(),
      'color': '#fff'
    }
  }, {
    title: "Example 3",
    metrics: [{
      text: "Something"
    }],
    style: {
      'background': Please.make_color(),
      'color': '#fff'
    }
  }]


  $scope.addColumn = function() {
    $scope.DATA.push({
      title: "New Column",
      style: {
        'background': Please.make_color(),
        'color': '#fff'
      },
      metrics: [{
        text: "Something"
      }]
    })
  }
  $scope.addMetric = function(metrics) {
    metrics.push({
      text: "Untitled",
      row: 1,
      column:1,
      style: {

      }
    })
  }

  console.log($scope.DATA)

})