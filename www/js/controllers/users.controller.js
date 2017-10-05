angular.module('garago.controllers.users', [])
  ////////////////////////
  /// LOGIN CONTROLLER //////////////////////////////////////////////////////
  ////////////////////////
  .controller('UsersCtrl', ['$scope', '$state', '$ionicModal', '$ionicPopup', '$localstorage', '$rootScope', '$ionicLoading', 'resolveData', function($scope, $state, $ionicModal, $ionicPopup, $localstorage, $rootScope, $ionicLoading, resolveData) {
    console.log("UsersCtrl Loaded")

    $scope.users = resolveData

    $scope.shouldShowDelete = false;
    $scope.shouldShowReorder = false;
    $scope.listCanSwipe = true

    $scope.showDelete = function(){
      $scope.shouldShowDelete = !$scope.shouldShowDelete;
    }

    $scope.showReOrder = function(){
      $scope.shouldShowReorder = !$scope.shouldShowReorder;
    }

  }])
