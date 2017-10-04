angular.module('garago.controllers.invite', [])
  ////////////////////////
  /// LOGIN CONTROLLER //////////////////////////////////////////////////////
  ////////////////////////
  .controller('InviteCtrl', ['$scope', '$state', '$ionicModal', '$ionicPopup', '$localstorage', '$rootScope', '$ionicLoading', function($scope, $state, $ionicModal, $ionicPopup, $localstorage, $rootScope, $ionicLoading) {
    console.log("Invite Ctrl Loaded")
    $scope.user = {}

    $scope.inviteUser = function(user){
      Parse.Cloud.run('inviteUser',{'email':user.email,'canUpload':user.canUpload}).then(function(res) {
        console.info("Invite Sent: ",res)
        $scope.user = {}
        var alertPopup = $ionicPopup.alert({
           title: 'Success!',
           template: "We've sent an email to "+user.email+ ". The user will now be able to register."
         });
        $scope.$apply()
      });
    }

  }])
