angular.module('garago.controllers.myuploads', [])

  .controller('MyUploadsCtrl', function($scope, $ionicModal, $timeout, $rootScope, $parseAPI, userUploads, $ionicLoading, $ionicHistory, $ionicPopup) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      console.log("MyUploadsCtrl Loaded.")
      Parse.User.current().fetch()
      $scope.refreshData()
    });

    $scope.fileNameChanged = function() {
      // console.log("CHANGED")
      $scope.filestoupload = true
      $scope.$apply()
    }
    $scope.filestoupload = false

    $scope.search = {
      text: ""
    }
    $scope.searchTags = []

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

    $scope.confirmDelete = function(file) {
     var confirmPopup = $ionicPopup.confirm({
       title: 'Warning',
       template: 'All changes will be lost. Are you sure you want to delete?'
     });

     confirmPopup.then(function(res) {
       if(res) {
         console.log('You are sure');
         $parseAPI.deleteUserFile(file).then(function(resp){
          console.log(resp)
          $scope.refreshData()
         })
       } else {
         console.log('You are not sure');
       }
     });
   };

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
        console.log(resp)
        var Files = Parse.Object.extend("Files")
        var query = new Parse.Query(Files)
        query.equalTo("objectId",file.id)
        query.include("comments")
        query.find({
          success: function(res){
            console.log("Found File: ",res)
          },
          error: function(e,r){
            console.loge,r
          }
        }).then(function(myFile){
          console.log(myFile)
          var relation = myFile[0].relation("comments")
          console.log(relation,resp[0])
          relation.add(resp[0])
          myFile[0].save({
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

    $scope.DATA = userUploads

    var Files = Parse.Object.extend("Files")
    $scope.refreshData = function() {
      $parseAPI.getUserFiles().then(function(res) {
        $scope.DATA = res
        $scope.$broadcast('scroll.refreshComplete');
      })
    }

    ////// Experimental Chips    
    $scope.readonly = true;
    $scope.selectedItem = null;
    $scope.searchText = null;
    $scope.querySearch = $scope.querySearch;
    // $scope.NOCcodes = loadNOCcodes( );
    $scope.selectedNOCcodes = [];
    $scope.numberChips = [];
    $scope.numberChips2 = [];
    $scope.numberBuffer = '';
    $scope.autocompleteDemoRequireMatch = true;
    $scope.transformChip = $scope.transformChip;

    /**
     * Return the proper object when the append is called.
     */
    $scope.transformChip = function(chip) {
      // If it is an object, it's already a known chip
      console.log(chip)
      if (angular.isObject(chip)) {
        console.log("return chip")
        return chip;
      }

      // Otherwise, create a new one
      console.log("make new chip")
      return { attributes: { title: chip.toLowerCase(), code: 0, lang: Parse.User.current().attributes.language, noc: "0" } }
    }

    /**
     * Search for NOC.
     */
    $scope.querySearch = function(query) {
      var myQuery = {
        attributes: {
          title: query.toLowerCase(),
          noc: "",
          lang: Parse.User.current().attributes.language,
          code: 0
        }
      }
      var results = myQuery ? queryCodes(query) : [];
      // var results = query.toLowerCase() ? $scope.NOCcodes.filter(createFilterFor(query.toLowerCase())) : [];
      return results;
    }

    function queryCodes(query) {
      Parse.User.current().fetch()
      var myQuery = query.toLowerCase()
      return Parse.Cloud.run('getNocCodes', { 'searchTerm': myQuery, 'userlang': Parse.User.current().attributes.language }).then(function(res) {
        console.info("NOC CODES: ", res)
        return res
      })
    }

    $scope.uploadFiles = function() {
      var $input = angular.element(document.getElementById('upload'));
      console.log($input.files)
      $ionicLoading.show({
        template: "Saving file(s)..."
      })
      $parseAPI.saveUserFile($input[0].files, $scope.searchTags).then(function(res) {
        // console.log("Save returned: ", res)
        $parseAPI.getUserFiles().then(function(res) {
          // console.log("Save returned: ", res)
          $scope.userFiles = res
          $input.val(null);
          $scope.searchTags = []
          $scope.filestoupload = false
          try{
            change_back()  
          }
          catch(e){
            console.log(e)
          }
        })
      }).then(function(res) {
        $ionicLoading.show({
          template: "Successfully Saved."
        })
        $scope.refreshData()
      })
    }

    $scope.refreshData = function() {
      $parseAPI.getUserFiles().then(function(res) {
        // console.log("Library View 'User Files' Resolve: ", res)
        $scope.DATA = res
        $scope.$broadcast('scroll.refreshComplete');
      })
    }

  })
