angular.module('garago.controllers.library_browse', [])

  .controller('LibraryBrowseCtrl', function ($scope, $ionicModal, $timeout, $rootScope, $parseAPI, userFilesData, $ionicLoading) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function (e) {
      console.log("LibraryBrowseCtrl Loaded.")
    });

    $scope.DATA = userFilesData

    $scope.addToFavs = function(fileID){
      console.log(fileID)
      Parse.Cloud.run('addUserFavFile', { 
        fileID: fileID
      }).then(function(res) {
        console.log(res)
      });
    }
    
  })
