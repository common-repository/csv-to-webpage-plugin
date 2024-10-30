(function ($) {
	$.extend({
		tablesorterPager: new function () {
			
			function updatePageDisplay(c) {               
				var s = $(c.cssPageDisplay, c.container).val((c.page + 1) + c.seperator + c.totalPages);
                               
			}
			
            function addPageList(table) {
                var c = table.config, i;
                c.totalPages = Math.ceil(c.totalRows / c.size);
                c.container.find('ul').empty();
                for (i = 1; i <= c.totalPages; i++) {
                    c.container.find('ul').append('<li>' + i + '</li>');
                }
            }
                        
			function setPageSize(table, size) {
				var c = table.config;
				c.size = size;
				c.totalPages = Math.ceil(c.totalRows / c.size);
				moveToPage(table);
               
			}
            
            function setPage(table, num) {
				var c = table.config;
				c.page = num;
				c.totalPages = Math.ceil(c.totalRows / c.size);
				moveToPage(table);
               
			}
			
			function fixPosition(table) {
				var c = table.config, o;
				if (!c.pagerPositionSet && c.positionFixed) {
					c = table.config;
                    o = $(table);
					if (o.offset) {
						c.container.css({
							top: o.offset().top + o.height() + 'px',
							position: 'absolute'
						});
					}
					c.pagerPositionSet = true;
				}
			}
			
			function moveToFirstPage(table) {
				var c = table.config;
				c.page = 0;
				moveToPage(table);
			}
			
			function moveToLastPage(table) {
				var c = table.config;
				c.page = (c.totalPages - 1);
				moveToPage(table);
			}
			
			function moveToNextPage(table) {
				var c = table.config;
				c.page++;
				if (c.page >= (c.totalPages - 1)) {
					c.page = (c.totalPages - 1);
				}
				moveToPage(table);
			}
			
			function moveToPrevPage(table) {
				var c = table.config;
				c.page--;
				if (c.page <= 0) {
					c.page = 0;
				}
				moveToPage(table);
			}
						
			
			function moveToPage(table) {
                
				var c = table.config;
				if (c.page < 0 || c.page > (c.totalPages - 1)) {
					c.page = 0;
				}
				
				renderTable(table, c.rowsCopy);
                
			}
            
            function addClass(table)
            {
                 var c = table.config;
                 c.container.find(c.goTo).children().removeClass('active');
                 c.container.find('li').eq(c.page).addClass('active');
               
            }
			
			function renderTable(table, rows) {
				
				var c = table.config,
                    l = rows.length,
				    s = (c.page * c.size),
                    e = (s + c.size),
                    i, 
                    j;
				if (e > rows.length) {
					e = rows.length;
				}
				
				
				var tableBody = $(table.tBodies[0]);
				
				// clear the table body
				
				$.tablesorter.clearTableBody(table);
				
				for (i = s; i < e; i++) {
					
					//tableBody.append(rows[i]);
					
					var o = rows[i];
					var l = o.length;
					for (j = 0; j < l; j++) {
						
						tableBody[0].appendChild(o[j]);

					}
				}
				
			
				$(table).trigger("applyWidgets");
				
				if (c.page >= c.totalPages) {
        			moveToLastPage(table);
				}
     
				addClass(table);
				updatePageDisplay(c);
			}
			
			this.appender = function(table,rows) {
				
				var c = table.config;
				c.rowsCopy = rows;
				c.totalRows = rows.length;
				c.totalPages = Math.ceil(c.totalRows / c.size);
				
				renderTable(table,rows);
                
			};
			
			this.defaults = {
				size: 10,
				offset: 0,
				page: 0,
				totalRows: 0,
				totalPages: 0,
				container: null,
				cssNext: '.next',
				cssPrev: '.prev',
				cssFirst: '.first',
				cssLast: '.last',
				cssPageDisplay: '.pagedisplay',
				cssPageSize: '.pagesize',
				seperator: "/",
				positionFixed: false,
                goTo : '.goTo',
				appender: this.appender
			};
			
			this.construct = function(settings) {
				
				return this.each(function() {	
					
					config = $.extend(this.config, $.tablesorterPager.defaults, settings);
                    	
					var table = this, pager = config.container;
				
					$(this).trigger("appendCache");
					
					config.size = parseInt($(".pagesize",pager).val());
                                        
                    addPageList(table);
					
					$(config.goTo,pager).on('click','li', function() {
                        pageNum  = parseInt($(this).html())-1;
						setPage(table, pageNum);
						return false;
					});
                   $(config.cssFirst,pager).click(function() {
						moveToFirstPage(table);
						return false;
					});
					$(config.cssNext,pager).click(function() {
                        //console.log(table.config.page);
						moveToNextPage(table);
						return false;
					});
					$(config.cssPrev,pager).click(function() {
						moveToPrevPage(table);
						return false;
					});
					$(config.cssLast,pager).click(function() {
						moveToLastPage(table);
						return false;
					});
					$(config.cssPageSize,pager).change(function() {
                       setPageSize(table,parseInt($(this).val()));
                       addPageList(table);
				       return false;
					});
				});
			};
			
		}
	});
	// extend plugin scope
	$.fn.extend({
        tablesorterPager: $.tablesorterPager.construct
	});
	
})(jQuery);				