angular.module('garago.controllers.library', [])

  .controller('LibraryCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $parseAPI, userFilesData, userSharedFilesData, userFavFilesData, FileUploader, $ionicLoading, $ionicPopup) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      // console.log("LibraryCtrl Loaded.")
      Parse.User.current().fetch()
      $scope.refreshData()
    });

    $scope.formatBytes = function(bytes) {
       var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
       if (bytes == 0) return '0 Byte';
       var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
       return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    };

    $scope.shouldShowDelete = false;
    $scope.shouldShowReorder = false;
    $scope.listCanSwipe = false

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

    $scope.toggleFilters = function(data) {
      $scope.showFilters = !$scope.showFilters
    }

    //// Set Init Data
    $scope.userFiles = userFilesData
    $scope.userFavFiles = userFavFilesData
    $scope.userSharedFiles = userSharedFilesData

    $scope.refreshData = function() {
      $parseAPI.getUserFiles().then(function(res) {
        // console.log("Library View 'User Files' Resolve: ", res)
        $scope.userFiles = res
        $scope.$broadcast('scroll.refreshComplete');
      })
      $parseAPI.getUserSharedFiles().then(function(res) {
        // console.log("Library View 'User Shared Files' Resolve: ", res)
        $scope.userSharedFiles = res
      })
      $parseAPI.getUserFavFiles(5).then(function(res) {
        // console.log("Library View 'User Fav Files' Resolve: ", res)
        $scope.userFavFiles = res
      })
    }

    $scope.clearSearch = function() {
      $scope.search = {}
      $scope.searchResults = []
      $scope.$apply()
    }

    $scope.searchFiles = function(search) {
      if (search.length > 0) {
        $parseAPI.searchFiles(search).then(function(res) {
          // console.log("Search returned: ", res)
          $scope.searchResults = res
        })
      } else {
        $scope.searchResults = []
        $scope.search = {}
        $scope.$apply()
      }
    }

    $scope.updateFileList = function(elem){
      console.log(elem.files)
      $scope.attachedFiles = elem.files
      $scope.$apply()
    }

    $scope.removeFileFromUploads = function($index){
      var $input = angular.element(document.getElementById('upload'));
      $input.splice($index,1)
    }

    $scope.uploadFiles = function(fileTitle) {
      var $input = angular.element(document.getElementById('upload'));
      console.log($input.files,$scope.searchTags)

      ///// check to make sure at least one official NOC
      var isValidNOC = $scope.searchTags.some(function(e,i){
        if(e.attributes.code != 0){
          console.log("YES")
          return true
        }else{
          console.log("NO")
          return false
        }
      })

      if($scope.searchTags.length == 0 || !isValidNOC){
        console.log("You must attach a NOC to your file")
        var alertPopup = $ionicPopup.alert({
           title: 'Warning!',
           template: 'You must attach a NOC to your upload(s)'
         });
      }else{
        $ionicLoading.show({
          template: "Saving file(s)..."
        })
        $parseAPI.saveUserFile($scope.attachedFiles, $scope.searchTags).then(function(res) {
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
        })
      }
    }

    $scope.confirmDelete = function(file) {
      var confirmPopup = $ionicPopup.confirm({
        title: 'Warning',
        template: 'All changes will be lost. Are you sure you want to delete?'
      });

      confirmPopup.then(function(res) {
        if (res) {
          // console.log('You are sure');
          $parseAPI.deleteUserFile(file).then(function(resp) {
            // console.log(resp)
            $ionicHistory.goBack()
          })
        } else {
          // console.log('You are not sure');
        }
      });
    };

    try {
      /// drag and drop style change on dragentert
      var drop = document.getElementById("upload");
      drop.addEventListener("dragenter", change, false);
      drop.addEventListener("dragleave", change_back, false);

      function change() {
        drop.style.backgroundColor = 'rgba(51, 205, 95, 0.1)';
      };

      function change_back() {
        drop.style.backgroundColor = 'transparent';
      };

    } catch (e) {
      console.log(e)
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

    // /**
    //  * Create filter function for a query string
    //  */
    // function createFilterFor(query) {
    //   var lowercaseQuery = angular.lowercase(query);

    //   return function filterFn(vegetable) {
    //     return (vegetable._lowername.indexOf(lowercaseQuery) === 0) ||
    //       (vegetable._lowertype.indexOf(lowercaseQuery) === 0);
    //   };

    // }

    $scope.toggleFav = function(file, state) {
      // console.log(file.id)
      Parse.User.current().fetch()
      var favs = Parse.User.current().attributes.fav_files || []
      if (state) {
        // console.log("REMOVE")
        var index = favs.indexOf(file.id);
        favs.splice(index, 1);
        Parse.User.current().set("fav_files", favs)
        Parse.User.current().save()
        Parse.User.current().fetch()
        $scope.refreshData()
      } else {
        // console.log("ADD")
        favs.push(file.id)
        Parse.User.current().set("fav_files", favs)
        Parse.User.current().save({
          success: function(res) {
            // console.log(res)
          },
          error: function(e, r) {
            // console.log(e, r)
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

    // function loadNOCcodes() {
    //   var veggies = [{
    //       'name': 'Research',
    //       'type': '24531'
    //     },
    //     {
    //       'name': 'Development',
    //       'type': '65456'
    //     },
    //     {
    //       'name': 'Marketing',
    //       'type': '87684'
    //     },
    //     {
    //       'name': 'Budgets',
    //       'type': '542335'
    //     },
    //     {
    //       'name': 'Activities',
    //       'type': '8786756'
    //     }
    //   ];

    //   return veggies.map(function(veg) {
    //     veg._lowername = veg.name.toLowerCase();
    //     veg._lowertype = veg.type.toLowerCase();
    //     return veg;
    //   });
    // }
  })
