(function(){"use stirct";if($("#report-donut-chart").length){let o=$("#report-donut-chart")[0].getContext("2d");new Chart(o,{type:"doughnut",data:{labels:["31 - 50 Years old",">= 50 Years old","17 - 30 Years old"],datasets:[{data:[15,10,65],backgroundColor:[getColor("pending",.9),getColor("warning",.9),getColor("primary",.9)],hoverBackgroundColor:[getColor("pending",.9),getColor("warning",.9),getColor("primary",.9)],borderWidth:5,borderColor:$("html").hasClass("dark")?getColor("darkmode.700"):getColor("white")}]},options:{maintainAspectRatio:!1,plugins:{legend:{display:!1}},cutout:"80%"}})}})();
