angular.module('garago.controllers.editfile', [])

  .controller('EditFileCtrl', function ($scope, $ionicModal, $timeout, $rootScope, $parseAPI, fileData, $ionicLoading, $ionicPopup) {

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

   $scope.confirmCancel = function() {
     var confirmPopup = $ionicPopup.confirm({
       title: 'Warning',
       template: 'All changes will be lost. Are you sure you want to cancel?'
     });

     confirmPopup.then(function(res) {
       if(res) {
         console.log('You are sure');
       } else {
         console.log('You are not sure');
       }
     });
   };

   $scope.confirmDelete = function() {
     var confirmPopup = $ionicPopup.confirm({
       title: 'Warning',
       template: 'All changes will be lost. Are you sure you want to cancel?'
     });

     confirmPopup.then(function(res) {
       if(res) {
         console.log('You are sure');
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
      var mytag = {
        name: tag,
        type: tag
      }
      return mytag
    })

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

      return function filterFn(tag) {
        return (tag.indexOf(lowercaseQuery) === 0) ||
          (tag.indexOf(lowercaseQuery) === 0);
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
      var veggies = $scope.FILE.attributes.tags

      return veggies.map(function(veg) {
        veg._lowername = veg.toLowerCase();
        veg._lowertype = veg.toLowerCase();
        return veg;
      });
    }
    
  })
