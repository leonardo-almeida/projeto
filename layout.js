Ext.require(['*']);
Ext.onReady(function(){
					 
			var item1 = Ext.create('Ext.Panel', {
            title: 'Clientes',
			contentEl: 'clientes'
            });

			var accordion = Ext.create('Ext.Panel', {
                region:'west',
                collapsible: true,
			title: 'Menu',
            split: true,
            width: '25%',
            minWidth: '25%',
			maxWidth: '25%',
                layout:'accordion',
                items: [item1]
            });
			
			var viewport = Ext.create('Ext.Viewport', {
                layout:'border',
                items:[
				{
            		region: 'north',
            		collapsible: true,
					header: false,
            split: true,
            		height: 130,
            		minHeight: 130,
					maxHeight: 130,
			contentEl: 'topo'
        			},
                    accordion, {
                    region:'center',
					autoScroll: true,
			contentEl: 'corpo'
                }]
            });
        });
