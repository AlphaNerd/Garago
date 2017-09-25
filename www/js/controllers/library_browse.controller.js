angular.module('garago.controllers.library_browse', [])

  .controller('LibraryBrowseCtrl', function($scope, $ionicModal, $timeout, $rootScope, $parseAPI, userFilesData, $ionicLoading) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      console.log("LibraryBrowseCtrl Loaded.")
      Parse.User.current().fetch()
      // $scope.refreshData()
    });

    $scope.shouldShowDelete = false;
    $scope.shouldShowReorder = false;
    $scope.listCanSwipe = true

    $scope.isFavFile = function(file) {
      var array = Parse.User.current().attributes.fav_files || []
      for (i = 0; i < array.length; i++) {
        if (array[i] == file.id) {
          return true
        }
      }
    }

    $scope.addComment = function(comment,file){
      console.log(comment,file)
      var Comment = Parse.Object.extend("Comments")
      var myComment = new Comment()
      myComment.set("text",comment)
      var user = {
        id: Parse.User.current().id,
        name: {
          first: Parse.User.current().attributes.firstname,
          last: Parse.User.current().attributes.lastname,
          username: Parse.User.current().attributes.username
        },
        email: Parse.User.current().attributes.email,
        image: Parse.User.current().attributes.image
      }
      myComment.set("createdBy",user)
      myComment.save({
        success: function(res){
          console.log(res)
        },
        error: function(e,r){
          console.log(e,r)
        }
      }).then(function(resp){
        console.log(file)
        var Files = Parse.Object.extend("Files")
        var files = new Parse.Query(Files)
        files.equalTo("objectId",file.id)
        files.find().then(function(res){
          console.log(file,res)
          var relation = res[0].relation("comments")
          relation.add(resp[0])
          res[0].save({
            success:function(res){
              $scope.commentIn = ""
              $scope.refreshData()
              console.log(res)
            },
            error: function(e,r){
              console.log(e,r)
            }
          }).then(function(res){
            console.log("SAVED COMMENT")
          })
        })
      })
    }

    $scope.toggleFav = function(file, state) {
      console.log(file.id)
      Parse.User.current().fetch()
      var favs = Parse.User.current().attributes.fav_files || []
      if (state) {
        console.log("REMOVE")
        var index = favs.indexOf(file.id);
        favs.splice(index, 1);
        Parse.User.current().set("fav_files", favs)
        Parse.User.current().save()
        Parse.User.current().fetch()
        $scope.refreshData()
      } else {
        console.log("ADD")
        favs.push(file.id)
        Parse.User.current().set("fav_files", favs)
        Parse.User.current().save({
          success: function(res) {
            console.log(res)
          },
          error: function(e, r) {
            console.log(e, r)
          }
        })
        Parse.User.current().fetch()
        $scope.refreshData()
      }
    }

    $scope.DATA = userFilesData

    var Files = Parse.Object.extend("Files")
    $scope.refreshData = function() {
      $parseAPI.getAllFiles().then(function(res) {
        $scope.DATA = res
        $scope.$broadcast('scroll.refreshComplete');
      })
    }

  })
