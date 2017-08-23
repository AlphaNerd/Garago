angular.module('garago.factory.mockApi', [])

  .factory('$mockApi', ['$http', '$timeout', '$q', '$ionicLoading', function($http, $timeout, $q, $ionicLoading) {
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
    function convertToParams(params) {
      var str = "";
      for (var key in params) {
        if (str != "") {
          str += "&";
        }
        str += key + "=" + encodeURIComponent(params[key]);
      }
      // console.log(str)
      return str
    }
    var obj = {
      ////// used for testing remote server is working
      test: function(){
        var deferred = $q.defer()
        var params = {
          id: null,
          status: "new",
          posEvent: "plan",
          data: null,
          Planing_id: null,
          historical_planing_id: null,
          image: null
        }
        // console.log(convertToParams(params))
        $http.post("https://dev.goforms.ca/sm/plans/test?" + convertToParams(params)).then(function(res) { 
          deferred.resolve(res)
        })
        return deferred.promise
      },
      getPlan: function() {
        var deferred = $q.defer()
        var params = {
          id: null,
          status: "get",
          posEvent: "plan",
          data: null,
          planing_id: 1,
          historical_planing_id: 1,
          image: null
        }
        // console.log(convertToParams(params))
        $http.post("https://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log("Successfully retrieved plan:",res)
          angular.forEach(res.data.typePlan,function(val,key){
            val.TypePlan.style = {
              'background': Please.make_color(),
              'color':'#fff'
            }
          })
          deferred.resolve(res.data)
        })
        return deferred.promise
      },
      newPlan: function(){
        var deferred = $q.defer()
        var params = {
          id: null,
          status: "new",
          posEvent: "plan",
          data: null,
          Planing_id: null,
          historical_planing_id: null,
          image: null
        }
        $http.post("https://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          deferred.resolve(res)
        })
        return deferred.promise
      },
      addColumn: function(data) {
        var deferred = $q.defer()
        console.log("Data In:", data)
        var params = {
          id: null,
          status: "new",
          posEvent: "column",
          data: null,
          planing_id: data.id,
          historical_planing_id: data.historical_id,
          image: null
        }
        console.log("URI: ",JSON.stringify(params))
        $http.get("https://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      deleteColumn: function(index, data) {
        var deferred = $q.defer()
        var params = {
          id:data.typePlan[index].TypePlan.id,
          status: "delete",
          posEvent: "column",
          data: null,
          planing_id: data.id,
          historical_planing_id: data.historical_id,
          image: null
        }
        console.log("URI: ",JSON.stringify(params))
        $http.get("https://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      addRow: function(data) {
        console.log(data)
        var deferred = $q.defer()
        var params = {
          id:null,
          status: "new",
          posEvent: "axis",
          data: null,
          planing_id: data.id,
          historical_planing_id: data.historical_id,
          image: null
        }
        console.log("URI: ",JSON.stringify(params))
        $http.get("https://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      deleteRow: function(index,data) {
        var deferred = $q.defer()
        console.log(data)
        var params = {
          id:data.Axis.id,
          status: "delete",
          posEvent: "axis",
          data: null,
          planing_id: null,
          historical_planing_id: data.Axis.historical_plan_id,
          image: null
        }
        console.log("URI: ",JSON.stringify(params))
        $http.get("https://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      moveColumn: function(index, data, event) {
        var deferred = $q.defer()
        var params = {
          id: from,
          status: "move",
          posEvent: "column",
          data: destination,
          planing_id: data.id,
          historical_planing_id: data.historical_id,
          image: null
        }
        $timeout(function() {
          var prev = event.element[0].attributes.column.value
          console.log(prev, index, [data], [event])
          newData.columns.move(prev, index)
          angular.forEach(newData.rows, function(val, key) {
            val.items.move(prev, index)
          })
          deferred.resolve(true)
        }, 50)
        return deferred.promise
      },
      moveRow: function(destination, data, event) {
        console.log([destination],[data],[event])
        var deferred = $q.defer()
        var from = data.axis.id
        var params = {
          id: from,
          status: "move",
          posEvent: "axis",
          data: destination,
          planing_id: data.id,
          historical_planing_id: data.historical_id,
          image: null
        }
        console.log(JSON.stringify(params))
        $http.get("https://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      edit: function(id,data){
        console.log(id,data)
        var deferred = $q.defer()
        var params = {
          id: id,
          status: "edit",
          posEvent: "type",
          data: data,
          planing_id: null,
          historical_planing_id: null,
          image: null
        }
        console.log(JSON.stringify(params))
        $http.get("https://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      toggleLock: function(item) {
        var deferred = $q.defer()
        $timeout(function() {
          item.locked = !item.locked
          deferred.resolve(true)
        }, 50)
        return deferred.promise
      },
      toggleEmuneration: function(state) {
        state = !state
        return state
      },
      getReportTitle: function() {
        return "Your Title Here"
      },
      saveReportTitle: function() {
        console.log("Save new plan title")
      },
      getTheme: function() {
        var theme = {
          colors: [Please.make_color(), Please.make_color(), Please.make_color()]
        }
        return theme
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