angular.module('garago.factory.api', [])

  .factory('$garagoAPI', ['$http', '$timeout', '$q', '$ionicLoading', '$rootScope', function($http, $timeout, $q, $ionicLoading, $rootScope) {
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
    function setColorScheme(){
      var colorString = Please.make_color()+"-"+Please.make_color()+"-"+Please.make_color()+"-"+Please.make_color()+"-"+Please.make_color()+"-"+Please.make_color()
      return colorString
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
        $http.post("http://dev.goforms.ca/sm/plans/test?" + convertToParams(params)).then(function(res) { 
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
        console.info("URI: http://dev.goforms.ca/sm/plans/planingJson/?",convertToParams(params))
        $http.post("http://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          /// add a splash of color
          angular.forEach(res.data.typePlan,function(val,key){
            val.TypePlan.style = {
              'background': val.TypePlan.style.background,
              'color':val.TypePlan.style.color || '#fff'
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
          data: setColorScheme(),
          Planing_id: null,
          historical_planing_id: null,
          image: null,
        }
        console.info("URI: http://dev.goforms.ca/sm/plans/planingJson/?",convertToParams(params))
        $http.post("http://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          deferred.resolve(res)
        })
        return deferred.promise
      },
      addColumn: function(data) {
        var deferred = $q.defer()
        var params = {
          status: "new",
          posEvent: "column",
          planing_id: data.id,
          historical_planing_id: data.historical_id,
        }
        console.info("URI: http://dev.goforms.ca/sm/plans/planingJson/?",convertToParams(params))
        $http.post("http://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.info(res)
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
        console.info("URI: ",JSON.stringify(params))
        $http.post("http://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      addRow: function(data) {
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
        console.info("URI: ",JSON.stringify(params))
        $http.post("http://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      deleteRow: function(index,data) {
        var deferred = $q.defer()
        var params = {
          id:data.Axis.id,
          status: "delete",
          posEvent: "axis",
          data: null,
          planing_id: null,
          historical_planing_id: data.Axis.historical_plan_id,
          image: null
        }
        console.info("URI: ",JSON.stringify(params))
        $http.post("http://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      moveColumn: function(index, data, event) {
        var deferred = $q.defer()
        var params = {
          id: data.TypePlan.id,
          destination: index,
          planing_id: $rootScope.DATA.id,
          historical_planing_id: $rootScope.DATA.historical_id,
        }
        console.info("URI: ",convertToParams(params))
        $http.post("http://dev.goforms.ca/sm/plans/moveRow/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      moveRow: function(index, data, event) {
        var deferred = $q.defer()
        var from = data.axis[0].Axis.id
        var params = {
          id: from,
          destination: index+1,
          planing_id: data.id,
          historical_planing_id: data.historical_id,
        }
        console.info(convertToParams(params))
        $http.post("http://dev.goforms.ca/sm/plans/moveAxis/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      editCell: function(id,data,attrs){
        var deferred = $q.defer()
        var params = {
          id: id,
          status: "edit",
          posEvent: attrs,
          data: data,
          planing_id: $rootScope.DATA.id,
          historical_planing_id: $rootScope.DATA.historical_id,
          image: null
        }
        console.info(convertToParams(params))
        $http.post("http://dev.goforms.ca/sm/plans/planingJson/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
        return deferred.promise
      },
      toggleLock: function(item) {
        var deferred = $q.defer()
        var params = {
          id: item.DetailPlan.id,
          locked: !item.DetailPlan.locked,
          planing_id: $rootScope.DATA.id,
          historical_planing_id: $rootScope.DATA.historical_id,
        }
        console.info(convertToParams(params))
        $http.post("http://dev.goforms.ca/sm/plans/lockedUnlockedCellById/?" + convertToParams(params)).then(function(res) {
          console.log(res)
          deferred.resolve(res)
        })
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
