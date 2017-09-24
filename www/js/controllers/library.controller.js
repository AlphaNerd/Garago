angular.module('garago.controllers.library', [])

  .controller('LibraryCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $parseAPI, userFilesData, userSharedFilesData, userFavFilesData, FileUploader, $ionicLoading) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      console.log("LibraryCtrl Loaded.")
      Parse.User.current().fetch()
      $scope.refreshData()
    });

    $scope.shouldShowDelete = false;
    $scope.shouldShowReorder = false;
    $scope.listCanSwipe = true

    $scope.fileNameChanged = function() {
      console.log("CHANGED")
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
        console.log("Library View 'User Files' Resolve: ", res)
        $scope.userFiles = res
        $scope.$broadcast('scroll.refreshComplete');
      })
      $parseAPI.getUserSharedFiles().then(function(res) {
        console.log("Library View 'User Shared Files' Resolve: ", res)
        $scope.userSharedFiles = res
      })
      $parseAPI.getUserFavFiles(5).then(function(res) {
        console.log("Library View 'User Fav Files' Resolve: ", res)
        $scope.userFavFiles = res
      })
    }

    $scope.clearSearch = function() {
      $scope.search = {}
      $scope.searchResults = []
    }

    $scope.searchFiles = function(search) {
      if (search.length > 0) {
        $parseAPI.searchFiles(search).then(function(res) {
          console.log("Search returned: ", res)
          $scope.searchResults = res
        })
      } else {
        $scope.searchResults = []
      }
    }

    $scope.uploadFiles = function() {
      $ionicLoading.show({
        template: "Saving file(s)...",
        duration: 3000
      })
      var $input = angular.element(document.getElementById('upload'));
      console.log($input[0].files)
      $parseAPI.saveUserFile($input[0].files, $scope.searchTags).then(function(res) {
        console.log("Save returned: ", res)
        $parseAPI.getUserFiles().then(function(res) {
          console.log("Save returned: ", res)
          $scope.userFiles = res
          $input.val(null);
          $scope.searchTags = []
          $scope.filestoupload = false
          change_back()
          $ionicLoading.hide()
        })
      })
    }

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


    ////// Experimental Chips    
    $scope.readonly = false;
    $scope.selectedItem = null;
    $scope.searchText = null;
    $scope.querySearch = $scope.querySearch;
    $scope.vegetables = loadVegetables();
    $scope.selectedVegetables = [];
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
      if (angular.isObject(chip)) {
        return chip;
      }

      // Otherwise, create a new one
      return { name: chip, type: 'new' }
    }

    /**
     * Search for vegetables.
     */
    $scope.querySearch = function(query) {
      var results = query ? $scope.vegetables.filter(createFilterFor(query)) : [];
      return results;
    }

    /**
     * Create filter function for a query string
     */
    function createFilterFor(query) {
      var lowercaseQuery = angular.lowercase(query);

      return function filterFn(vegetable) {
        return (vegetable._lowername.indexOf(lowercaseQuery) === 0) ||
          (vegetable._lowertype.indexOf(lowercaseQuery) === 0);
      };

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

    function loadVegetables() {
      var veggies = [{
          'name': 'Research',
          'type': '24531'
        },
        {
          'name': 'Development',
          'type': '65456'
        },
        {
          'name': 'Marketing',
          'type': '87684'
        },
        {
          'name': 'Budgets',
          'type': '542335'
        },
        {
          'name': 'Activities',
          'type': '8786756'
        }
      ];

      return veggies.map(function(veg) {
        veg._lowername = veg.name.toLowerCase();
        veg._lowertype = veg.type.toLowerCase();
        return veg;
      });
    }
  })
