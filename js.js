/**
 *
 */
window.onload = function () {
	    showProcess(today);
	};
	// 前の月表示
	function prev(){
	    showDate.setMonth(showDate.getMonth() - 1);
	    showProcess(showDate);
	}

	// 次の月表示
	function next(){
	    showDate.setMonth(showDate.getMonth() + 1);
	    showProcess(showDate);
	}

	// カレンダー表示
	function showProcess(date) {
	    var year = date.getFullYear();
	    var month = date.getMonth();
	    document.querySelector('#header').innerHTML = year + "年 " + (month + 1) + "月";

	    var calendar = createProcess(year, month);
	    document.querySelector('#calendar').innerHTML = calendar;
	}

	// カレンダー作成
	function createProcess(year, month) {
	    // 曜日
	    var calendar = "<table><tr class='dayOfWeek'>";
	    for (var i = 0; i < week.length; i++) {
	        calendar += "<th>" + week[i] + "</th>";
	    }
	    calendar += "</tr>";

	    var count = 0;
	    var startDayOfWeek = new Date(year, month, 1).getDay();
	    var endDate = new Date(year, month + 1, 0).getDate();
	    var lastMonthEndDate = new Date(year, month, 0).getDate();
	    var row = Math.ceil((startDayOfWeek + endDate) / week.length);

	    // 1行ずつ設定
	    for (var i = 0; i < row; i++) {
	        calendar += "<tr>";
	        // 1colum単位で設定
	        for (var j = 0; j < week.length; j++) {
	            if (i == 0 && j < startDayOfWeek) {
	                // 1行目で1日まで先月の日付を設定
	                calendar += "<td class='disabled'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
	            } else if (count >= endDate) {
	                // 最終行で最終日以降、翌月の日付を設定
	                count++;
	                calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
	            } else {
	                // 当月の日付を曜日に照らし合わせて設定
	                count++;
	                var a=check(year,month,count);
	                if(year == today.getFullYear()
	                  && month == (today.getMonth())
	                  && count == today.getDate()){
	                    calendar += "<td class='today'>" + count +"<div class='coment'>today</div></td>";
	                }else if(a[0]==0){
	                	calendar += "<td class='syukin'>" + count + "<div class='coment'><h4>coment</h4>"+database[a[1]][2]+"</div></td>";
	                }else if(a[0]==1){
	                	calendar += "<td class='set'>" + count + "<div class='coment'><h4>coment</h4>"+database[a[1]][2]+"</div></td>";
	                }else{
	                		calendar += "<td>" + count + "</td>";
	                	}

	            }
	        }
	        calendar += "</tr>";
	    }
	    return calendar;
	}

	function bo(){
		var date= new Date();
		var str="<option selected disabled>"+date.getFullYear()+"</option>";
		for(var i=2010;i<2040;i++){
			str+=" <option value='"+i+"'>"+i+"</option>";
		}
		document.querySelector('#year').innerHTML = str;//year

		str="<option selected disabled>"+(date.getMonth()+1)+"</option>";
		for(var i=1;i<13;i++){
			str+=" <option value='"+i+"'>"+i+"</option>";
		}
		document.querySelector('#month').innerHTML = str;

	}
	function onch(){
		var year=parseInt(document.getElementById("year").value,10);
		var month=parseInt(document.getElementById("month").value,10)-1;
		var date= new Date(year,month,1);
		this.showProcess(date);
		return 0;
	}

	bo();
	function check(year,month,date){
		for(var i=0;i<database.length;i++){
			var data=database[i][0].split("-");
			var b=new Date(parseInt(data[0]),parseInt(data[1]),parseInt(data[2]),1);
			console.log(b.getFullYear());
			console.log(b.getDate());
			console.log(b.getDate());
			if(year == b.getFullYear()
                    && month == (b.getMonth()-1)
                    && date == b.getDate()){
						console.log(database[i][1]);
				if(database[i][1]=="学校"){
					return [0,i];
				}
				else if(database[i][1]=="バイト"){
					return [1,i];
				}
			}
		}
		return [2,-1];
	}