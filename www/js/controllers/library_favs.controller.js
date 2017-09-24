angular.module('garago.controllers.library_favs', [])

  .controller('LibraryFavsCtrl', function ($scope, $ionicModal, $timeout, $rootScope, $parseAPI, userFilesData, $ionicLoading) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function (e) {
      console.log("LibraryFavsCtrl Loaded.")
    });

    $scope.DATA = userFilesData

    $scope.refreshData = function(){
      $parseAPI.getUserFiles().then(function (res) {
        $scope.DATA = res
      })
    }

    $scope.addToFavs = function(fileID){
      console.log(fileID)
      Parse.Cloud.run('addUserFavFile', { 
        fileID: fileID
      }).then(function(res) {
        console.log(res)
        $scope.refreshData()
      });
    }

    $scope.isFavFile = function(item){
      // console.log(item)
      return angular.forEach(item.users_favorite,function(val,key){
        // console.log(val,Parse.User.current().id)
        if(val === Parse.User.current().id){
          return true
        }else{
          return false
        }
      })
    }
    
  })
