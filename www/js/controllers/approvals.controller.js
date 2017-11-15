angular.module('garago.controllers.approvals', [])

  .controller('ApprovalsCtrl', function($scope, $ionicModal, $timeout, $rootScope, $parseAPI, userFilesData, $ionicLoading, $ionicHistory, $ionicPopup) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      Parse.User.current().fetch()
    });

    $scope.DATA = userFilesData

    

  })
