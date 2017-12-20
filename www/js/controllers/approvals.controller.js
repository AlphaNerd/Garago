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


    $scope.refreshData = function() {
      $parseAPI.getApprovals().then(function(res) {
        $scope.DATA = res
        $scope.$broadcast('scroll.refreshComplete');
      })
    }

    $scope.approveFile = function(file) {
      console.log("toggle approve for file ", file)
      var FILES = Parse.Object.extend("Files")
      var query = new Parse.Query(FILES)
      query.equalTo("objectId", file.id)
      query.find().then(function(res) {
        console.log("Retreaved file: ", res)
        res[0].set("active", true)
        res[0].save().then(function(res) {
          console.log(res)
          $scope.refreshData()
          Parse.Cloud.run("fileapproved", {
            title: file.attributes.title,
            sendTo: file.attributes.createdByUser.email
          })
        })
      })
    }

    $scope.declineFile = function(file) {
      console.log("toggle approve for file ", file)
      var confirmPopup = $ionicPopup.confirm({
        title: 'Warning!',
        template: 'Are you sure you want to decline this file?'
      });
      confirmPopup.then(function(res) {
        if (res) {
          var FILES = Parse.Object.extend("Files")
          var query = new Parse.Query(FILES)
          query.equalTo("objectId",file.id)
          query.find().then(function(res){
            console.log("Retreaved file: ",res)
            res[0].set("active",false)
            res[0].save().then(function(res){
              console.log(res)
                Parse.Cloud.run("filedeclined",{
                  title: file.attributes.title,
                  sendTo: file.attributes.createdByUser.email
                })
              $scope.refreshData()
            })
          })
        } else {
          console.log('You are not sure');
        }
      })
    }



  })
