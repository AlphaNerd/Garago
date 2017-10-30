angular.module('garago.controllers.library_favs', [])

  .controller('LibraryFavsCtrl', function ($scope, $ionicModal, $timeout, $rootScope, $parseAPI, userFilesData, $ionicLoading) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function (e) {
      console.log("LibraryFavsCtrl Loaded.")
      Parse.User.current().fetch()
      $scope.refreshData()
    });

    $scope.shouldShowDelete = false;
    $scope.shouldShowReorder = false;
    $scope.listCanSwipe = false
    
    $scope.DATA = userFilesData

    $scope.refreshData = function(){
      $parseAPI.getUserFavFiles().then(function (res) {
        $scope.DATA = res
        $scope.$broadcast('scroll.refreshComplete');
      })
    }

    $scope.isFavFile = function(file){
      var array = Parse.User.current().attributes.fav_files
      for(i=0;i<array.length;i++){
        if(array[i] == file.id){
          return true
        }
      }
    }

    $scope.toggleFav = function(file,state){
      console.log(file.id)
      Parse.User.current().fetch()
      var favs = Parse.User.current().attributes.fav_files
      if(state){
        console.log("REMOVE")
        var index = favs.indexOf(file.id);
        favs.splice(index, 1);
        Parse.User.current().set("fav_files",favs)
        Parse.User.current().save()
        Parse.User.current().fetch()
        $scope.refreshData()
      }else{
        console.log("ADD")
        favs.push(file.id)
        Parse.User.current().set("fav_files",favs)
        Parse.User.current().save({
          success: function(res){
            console.log(res)
          },
          error: function(e,r){
            console.log(e,r)
          }
        })
        Parse.User.current().fetch()
        $scope.refreshData()
      }
    }


    $scope.countDownload = function(file){
      console.log(file)
      var Files = Parse.Object.extend("Files")
      var query = new Parse.Query(Files)
      query.equalTo("objectId",file.id)
      query.find().then(function(res){
        var count = (res[0].attributes.totalDownloads || 0) +1
        res[0].set("totalDownloads",count)
        res[0].save().then(function(res){
          console.log("Added to download count")
          $scope.refreshData()
        })
      })
    }
    
  })
