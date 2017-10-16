angular.module('garago.controllers.invite', [])
  ////////////////////////
  /// LOGIN CONTROLLER //////////////////////////////////////////////////////
  ////////////////////////
  .controller('InviteCtrl', ['$scope', '$state', '$ionicModal', '$ionicPopup', '$localstorage', '$rootScope', '$ionicLoading', '$parseAPI', function($scope, $state, $ionicModal, $ionicPopup, $localstorage, $rootScope, $ionicLoading, $parseAPI) {
    console.log("Invite Ctrl Loaded")
    $scope.user = {}

    $scope.region = null;
    $scope.regions = null;

    $scope.inviteUser = function(user){
      $ionicLoading.show({
        template: "Sending invite..."
      })
      Parse.Cloud.run('inviteUser',{'email':user.email,'canUpload':user.canUpload,'isAdmin':user.isAdmin,'regionName':user.regionName}).then(function(res) {
        console.info("Invite Sent: ",res)
        $scope.user = {}
        var alertPopup = $ionicPopup.alert({
           title: 'Success!',
           template: "We've sent an email to "+user.email+ ". The user will now be able to register."
         });
        $scope.$apply()
        $ionicLoading.hide()
      });
    }

    $scope.getRegions = function() {

      // Use timeout to simulate a 650ms request.
      return $parseAPI.getRegions().then(function(res){
        console.log
        $scope.regions = res || []
      })
    };

  }])
