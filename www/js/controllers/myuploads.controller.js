angular.module('garago.controllers.myuploads', [])

  .controller('MyUploadsCtrl', function($scope, $ionicModal, $timeout, $rootScope, $parseAPI, userUploads, $ionicLoading, $ionicHistory, $ionicPopup, $ionicModal) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      console.log("MyUploadsCtrl Loaded.")
      Parse.User.current().fetch()
      $scope.refreshData()
    });

    $scope.updateFileList = function(elem){
      console.log(elem.files)
      $scope.attachedFiles = elem.files
      $scope.$apply()
    }


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
    $scope.listCanSwipe = false

    $scope.isFavFile = function(file) {
      var array = Parse.User.current().attributes.fav_files || []
      for (i = 0; i < array.length; i++) {
        if (array[i] == file.id) {
          return true
        }
      }
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

    $scope.uploadFiles = function(fileTitle) {
      var $input = angular.element(document.getElementById('upload'));
      console.log($input.files)

      if($scope.searchTags.length == 0){
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
            $scope.closeModal()
            try{
              change_back()
            }
            catch(e){
              console.log(e)
            }
            $scope.refreshData()
          })
        }).then(function(res) {
          $ionicLoading.show({
            template: "Successfully Saved."
          })
        })
      }
    }

    $scope.refreshData = function() {
      $parseAPI.getUserFiles().then(function(res) {
        // console.log("Library View 'User Files' Resolve: ", res)
        $scope.DATA = res
        $scope.$broadcast('scroll.refreshComplete');
      })
    }

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

    $ionicModal.fromTemplateUrl('../../templates/modals/upload-modal.html', {
      scope: $scope,
      animation: 'slide-in-up'
    }).then(function(modal) {
      $scope.modal = modal;
    });
    $scope.openModal = function() {
      $scope.modal.show();
    };
    $scope.closeModal = function() {
      $scope.modal.hide();
    };

  })
