angular.module('garago.controllers.library', [])

  .controller('LibraryCtrl', function ($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $parseAPI, userFilesData, userSharedFilesData, FileUploader, $ionicLoading) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function (e) {
      console.log("LibraryCtrl Loaded.")
    });

    $scope.search = {
      text: ""
    }
    $scope.searchTags = []

    $scope.toggleFilters = function (data) {
      $scope.showFilters = !$scope.showFilters
    }

    $scope.userFiles = userFilesData
    $scope.userSharedFiles = userSharedFilesData

    $scope.clearSearch = function(){
      $scope.search = {}
      $scope.searchResults = []
    }

    $scope.searchFiles = function (search) {
      if (search.length > 0) {
        $parseAPI.searchFiles(search).then(function (res) {
          console.log("Search returned: ", res)
          $scope.searchResults = res
        })
      } else {
        $scope.searchResults = []
      }
    }

    $scope.uploadFiles = function(){
      $ionicLoading.show({
        template: "Saving file(s)...",
        duration: 3000
      })
      var $input = angular.element(document.getElementById('upload'));
      console.log($input[0].files)
      $parseAPI.saveUserFile($input[0].files,$scope.searchTags).then(function (res) {
        console.log("Save returned: ", res)
        $parseAPI.getUserFiles().then(function (res) {
          console.log("Save returned: ", res)
          $scope.userFiles = res
          $input.val(null);
          $scope.searchTags = []
          $ionicLoading.hide()
        })
      })
    }



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

    function loadVegetables(){
      var veggies = [
        {
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

      return veggies.map(function (veg) {
        veg._lowername = veg.name.toLowerCase();
        veg._lowertype = veg.type.toLowerCase();
        return veg;
      });
    }
  })
