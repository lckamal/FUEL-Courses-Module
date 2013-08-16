var DudbcController = {
	
	init : function(initObj){
		this._super(initObj);
	},
	add_edit : function(){

		// call parent
		fuel.controller.BaseFuelController.prototype.add_edit.call(this);

		
	}
		
};
jqx.extendController(DudbcController);
