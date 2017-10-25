angular.module('garago.controllers.editfile', [])

  .controller('EditFileCtrl', function ($scope, $ionicModal, $timeout, $rootScope, $parseAPI, fileData, $ionicLoading, $ionicPopup, $ionicHistory) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function (e) {
      console.log("EditFileCtrl Loaded.")
    });

    $scope.FILE = fileData
    
    $scope.confirmSave = function() {
     var confirmPopup = $ionicPopup.confirm({
       title: 'Confirm',
       template: 'Save file with new data?'
     });

     confirmPopup.then(function(res) {
       if(res) {
         console.log('You are sure');
       } else {
         console.log('You are not sure');
       }
     });
   };

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
          $ionicHistory.goBack()
         })
       } else {
         console.log('You are not sure');
       }
     });
   };


    ////// TAG RELATED JUNK
    $scope.search = {
      text: ""
    }

    $scope.searchTags = $scope.FILE.attributes.tags.map(function(tag){
      console.log(tag)
      var mytag = {attributes: {
        title: tag.title,
        noc: "noc",
        code: 0,
        lang: 'en'
      }}
      return mytag
    })
    


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
      console.log(query)
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

    $scope.isFavFile = function(file) {
      var array = Parse.User.current().attributes.fav_files || []
      for (i = 0; i < array.length; i++) {
        if (array[i] == file.id) {
          return true
        }
      }
    }
  


    $scope.updateFile = function(tags,title) {
      console.log($scope.FILE)
      if($scope.searchTags.length == 0){
        console.log("You must attach a NOC to your file")
        var alertPopup = $ionicPopup.alert({
           title: 'Warning!',
           template: 'You must attach a NOC to your upload(s)'
         });
      }else{
        $ionicLoading.show({
          template: "Saving file..."
        })
        var tagArray = tags.map(function (item) {
          var obj = {
            title: item.attributes.title,
            noc: item.attributes.noc
          }
          return obj
        });
        $scope.FILE.set("title",title)
        $scope.FILE.set("tags",tagArray)
        $scope.FILE.save().then(function(res){
          console.log("FILE UPDATED!")
          $ionicHistory.goBack()
        })
      }
    }
    
  })

