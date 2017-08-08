angular.module('starter.factory.mockdata', [])

  .factory('$mockdata', ['$http', '$timeout', '$q', '$ionicLoading', function($http, $timeout, $q, $ionicLoading) {
    Array.prototype.move = function(old_index, new_index) {
      if (new_index >= this.length) {
        var k = new_index - this.length;
        while ((k--) + 1) {
          this.push(undefined);
        }
      }
      this.splice(new_index, 0, this.splice(old_index, 1)[0]);
      return this; // for testing purposes
    };
    var obj = {
      get: function() {
        return newData
      },
      addColumn: function() {
        var deferred = $q.defer()
        //// simulate async call - replace $timeout with $http request
        $ionicLoading.show({ template: "Adding Column..." })
        $timeout(function() {
          newData.columns.push({
            id: 0,
            title: "Type your text",
            style: {
              'background': Please.make_color(),
              'color': '#fff'
            },
            locked: true
          })
          angular.forEach(newData.rows, function(val, key) {
            val.items.push({
              id: 0,
              content: "",
              style: {
                'background': Please.make_color(),
                'color': '#fff'
              },
              locked: false
            })
          })
          $ionicLoading.hide()
          deferred.resolve(true)
        }, 50)
        return deferred.promise
      },
      addRow: function() {
        var deferred = $q.defer()
        $timeout(function() {
          newData.rows.push({
            id: newData.rows.length,
            items: createEmptyRow()
          })
        }, 50)
        return deferred.promise
      },
      deleteRow: function(index, obj) {
        var deferred = $q.defer()
        $timeout(function() {
          console.log(index)
          newData.rows.splice(index, 1)
        }, 50)
        return deferred.promise
      },
      deleteColumn: function(index, obj) {
        var deferred = $q.defer()
        $timeout(function() {
          console.log(index)
          newData.columns.splice(index, 1)
          angular.forEach(newData.rows, function(val, key) {
            val.items.splice(key, 1)
          })
        }, 50)
        return deferred.promise
      },
      moveColumn: function(index, data, event) {
        var deferred = $q.defer()
        $timeout(function() {
          var prev = event.element[0].attributes.column.value
          console.log(prev, index, [data], [event])
          newData.columns.move(prev, index)
          angular.forEach(newData.rows, function(val, key) {
            val.items.move(prev, index)
          })
        }, 50)
        return deferred.promise
      },
      moveRow: function(index, data, event) {
        var deferred = $q.defer()
        $timeout(function() {
          var prev = event.element[0].attributes.row.value
          console.log(prev, index, [data], [event])
          newData.rows.move(prev, index)
        }, 50)
        return deferred.promise
      }
    }
    return obj
  }])

function createEmptyRow() {
  var data = []
  for (i = 0; i < newData.columns.length; i++) {
    data.push({
      id: i,
      content: "<b>Some</b> content",
      style: {
        'background': Please.make_color(),
        'color': '#fff'
      },
      locked: false
    })
  }
  return data
}

var newData = {
  columns: [{
    id: 0,
    title: "Some Title",
    style: {
      'background': Please.make_color(),
      'color': '#fff'
    },
    locked: true
  }, {
    id: 1,
    title: "Some Other Title",
    style: {
      'background': Please.make_color(),
      'color': '#fff'
    },
    locked: false
  }, {
    id: 1,
    title: "Some Other Title",
    style: {
      'background': Please.make_color(),
      'color': '#fff'
    },
    locked: false
  }],
  rows: [{
    id: 0,
    title: "Title Here",
    items: [{
      id: 0,
      content: "<b>Some</b> content",
      style: {
        'background': Please.make_color(),
        'color': '#fff'
      },
      locked: false
    }, {
      id: 0,
      content: "<b>Some</b> new content",
      style: {
        'background': Please.make_color(),
        'color': '#fff'
      },
      locked: true
    }, {
      id: 0,
      content: "<b>Some</b> other content",
      style: {
        'background': Please.make_color(),
        'color': '#fff'
      },
      locked: false
    }]
  }, {
    id: 1,
    title: "Title Here",
    items: [{
      id: 0,
      content: "<b>Some</b> content",
      style: {
        'background': Please.make_color(),
        'color': '#fff'
      },
      locked: true
    }, {
      id: 0,
      content: "<b>Some</b> new content",
      style: {
        'background': Please.make_color(),
        'color': '#fff'
      },
      locked: false
    }, {
      id: 0,
      content: "<b>Some</b> other content",
      style: {
        'background': Please.make_color(),
        'color': '#fff'
      },
      locked: false
    }]
  }]
}
