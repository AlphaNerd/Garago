angular.module('starter.factory.mockdata', [])

  .factory('$mockdata', ['$http', function($http) {
    var obj = {
      get: function() {
        return newData
      },
      addColumn: function() {
      	newData.columns.push({
			id: 0,
			title: "Type your text",
			style: {
				'background': Please.make_color(),
	    		'color': '#fff'
			},
			locked: true
		})
		angular.forEach(newData.rows,function(val,key){
			val.items.push({
				id: 0,
				content: "",
				style: {
					'background': Please.make_color(),
					'color':'#fff'
				},
				locked: false
			})
		})
      },
      addRow: function(){
      	newData.rows.push({
			id:newData.rows.length,
			items: createEmptyRow()
      	})
      },
      deleteRow: function(index){
      	console.log(index)
      	newData.rows.splice(index,1)
      },
      deleteColumn: function(index){
      	console.log(index)
      	newData.columns.splice(index,1)
      	angular.forEach(newData.rows,function(val,key){
      		val.items.splice(key,1)
      	})
      }
    }
    return obj
  }])

function createEmptyRow(){
	var data = []
	for (i=0;i<newData.columns.length;i++){
		data.push({
			id: i,
			content: "<b>Some</b> content",
			style: {
				'background': Please.make_color(),
				'color':'#fff'
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
	},{
		id: 1,
		title: "Some Other Title",
		style: {
			'background': Please.make_color(),
    		'color': '#fff'
		},
		locked: false
	},{
		id: 1,
		title: "Some Other Title",
		style: {
			'background': Please.make_color(),
    		'color': '#fff'
		},
		locked: false
	}],
	rows: [{
		id:0,
		title: "Title Here",
		items: [{
			id: 0,
			content: "<b>Some</b> content",
			style: {
				'background': Please.make_color(),
				'color':'#fff'
			},
			locked: false
		},{
			id: 0,
			content: "<b>Some</b> new content",
			style: {
				'background': Please.make_color(),
				'color':'#fff'
			},
			locked: true
		},{
			id: 0,
			content: "<b>Some</b> other content",
			style: {
				'background': Please.make_color(),
				'color':'#fff'
			},
			locked: false
		}]
	},{
		id:1,
		title: "Title Here",
		items: [{
			id: 0,
			content: "<b>Some</b> content",
			style: {
				'background': Please.make_color(),
				'color':'#fff'
			},
			locked: true
		},{
			id: 0,
			content: "<b>Some</b> new content",
			style: {
				'background': Please.make_color(),
				'color':'#fff'
			},
			locked: false
		},{
			id: 0,
			content: "<b>Some</b> other content",
			style: {
				'background': Please.make_color(),
				'color':'#fff'
			},
			locked: false
		}]
	}]
}