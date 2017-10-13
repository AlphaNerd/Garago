angular.module('garago.controllers.users', [])
  ////////////////////////
  /// LOGIN CONTROLLER //////////////////////////////////////////////////////
  ////////////////////////
  .controller('UsersCtrl', ['$scope', '$state', '$ionicModal', '$ionicPopup', '$localstorage', '$rootScope', '$ionicLoading', 'resolveData', '$parseAPI', '$timeout', function($scope, $state, $ionicModal, $ionicPopup, $localstorage, $rootScope, $ionicLoading, resolveData, $parseAPI, $timeout) {
    console.log("UsersCtrl Loaded")

    $scope.users = resolveData

    $scope.shouldShowDelete = false;
    $scope.shouldShowReorder = false;
    $scope.listCanSwipe = true

    $scope.showDelete = function() {
      $scope.shouldShowDelete = !$scope.shouldShowDelete;
    }

    $scope.showReOrder = function() {
      $scope.shouldShowReorder = !$scope.shouldShowReorder;
    }

    $scope.deleteUser = function(index, user) {
      console.log("Delete this user: ", user.id)
      $parseAPI.deleteUserByID(user.id).then(function(res) {
        console.log("User Deleted: ", res)
        if (res) {
          $scope.users.splice(index, 1)
        } else {
          console.log("error deleting user")
        }
      })
    }


    $scope.toggleUploadPrivileges = function(user) {
      var data = user.attributes.canUpload
      var userid = user.id
      console.log(userid,data)
      Parse.Cloud.run('toggleUploadPrivileges', { 'userid': userid,'mydata': data }).then(function(res) {
        console.info("Toggle Privileges Response: ", res)
        Parse.Cloud.run('getAllUsers',{}).then(function(res) {
          console.log("Users resolve data: ",res)
          $scope.users = res
          $scope.$apply()
        })
      })
    }

  }])
