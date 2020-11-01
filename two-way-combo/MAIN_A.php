<html>
 <head>
  <title>MAIN_A</title>
  <script type="text/javascript" src="knockout-3.5.1.js"></script>
  <script type="text/javascript" src="jquery-3.5.1.js"></script>
  	<style>
		* {
		  box-sizing: border-box;
		}

		.column {
		  float: left;
		  width: 25%;
		  padding: 10px;
		}

		/* Clearfix (clear floats) */
		.row::after {
		  content: "";
		  clear: both;
		  display: table;
		}
		div 
		{
			background-image: url('wall_stone.jpg');
		}
	</style>
 </head>
	<body>
	
	<p id="obj"></p>
	
	 <div class="row">
		<div class="column">
			<img id="Stone_I1" src="lightstones/lightblack.png" style="width:50%"></img>
		</div>
		<div class="column">
			<img id="Stone_I2" src="lightstones/lightblack.png" style="width:50%"></img>
		</div>
	</div> 
	
	<div class="row">
		<div class="column">
			<img id="Stone_1" src="greenstones/birth.png" style="width:50%"></img>
		</div>
		<div class="column">
			<img id="Stone_2" src="greenstones/birth.png" style="width:50%"></img>
		</div>
		<div class="column">
			<img id="Stone_3" src="greenstones/birth.png" style="width:50%"></img>
		</div>
		<div class="column">
			<img id="Stone_4" src="greenstones/birth.png" style="width:50%"></img>
		</div>
	</div> 
	
	<div class="row">
		<div class="column">
			<img id="Stone_A" src="whitestones/healing.png" style="width:50%"></img>
		</div>
		<div class="column">
			<img id="Stone_2" src="whitestones/strength.png" style="width:50%"></img>
		</div>
		<div class="column">
			<img id="Stone_3" src="whitestones/war.png" style="width:50%"></img>
		</div>
		<div class="column">
			<img id="Stone_4" src="whitestones/birth.png" style="width:50%"></img>
		</div>
	</div> 
	
	<div class="row">
		<div class="column">
			<img id="Wheel_A" src="wheelstones/wheelbirth.png" style="width:90%"></img>
		</div>
		<div class="column">
			<img id="Wheel_B" src="wheelstones/wheelbirth.png" style="width:90%"></img>
		</div>
		<div class="column">
			<img id="Wheel_C" src="wheelstones/wheelbirth.png" style="width:90%"></img>
		</div>
		<div class="column">
			<img id="Wheel_D" src="wheelstones/wheelbirth.png" style="width:90%"></img>
		</div>
	</div> 

	<div class="row">
		<div class="column">
			<button data-bind="click: incrementWheelA"><==</button> <button data-bind="click: decrementWheelA">==></button>
		</div>
		<div class="column">
			<button data-bind="click: incrementWheelB"><==</button> <button data-bind="click: decrementWheelB">==></button>
		</div>
		<div class="column">
			<button data-bind="click: incrementWheelC"><==</button> <button data-bind="click: decrementWheelC">==></button>
		</div>
		<div class="column">
			<button data-bind="click: incrementWheelD"><==</button> <button data-bind="click: decrementWheelD">==></button>
		</div>
	</div> 

	<script type="text/javascript">
		function read_storage_A(arr)
		{
			var s = document.createElement("script");
			s.src = "read_storage_A.php?x=" + JSON.stringify(arr);
			document.body.appendChild(s);
		};
		
		function read_storage_B(arr)
		{
			var s = document.createElement("script");
			s.src = "read_storage_B.php?x=" + JSON.stringify(arr);
			document.body.appendChild(s);
		};
		
		function read_storage_S(arr)
		{
			var s = document.createElement("script");
			s.src = "read_storage_S.php?x=" + JSON.stringify(arr);
			document.body.appendChild(s);
		};
		
		function write_storage(arr)
		{
			var s = document.createElement("script");
			s.src = "write_storage_B.php?x=" + JSON.stringify(arr);
			document.body.appendChild(s);
		};
		
		function write_storage_S(arr)
		{
			var s = document.createElement("script");
			s.src = "write_storage_S.php?x=" + JSON.stringify(arr);
			document.body.appendChild(s);
		};
		
		var viewModel = 
		{
			wheel_a : ko.observable(0),
			incrementWheelA : function()
			{
				var previousCount = this.wheel_a();
				this.wheel_a(previousCount+1);
				if(this.wheel_a() > 7)
				{
					this.wheel_a(0);
				};
				write_storage({"data":this.wheel_a(),"index":"A"});
			},
			decrementWheelA : function()
			{
				var previousCount = this.wheel_a();
				this.wheel_a(previousCount-1);
				if(this.wheel_a() < 0)
				{
					this.wheel_a(7);
				};
				write_storage({"data":this.wheel_a(),"index":"A"});
			},
			wheel_b : ko.observable(0),
			incrementWheelB : function()
			{
				var previousCount = this.wheel_b();
				this.wheel_b(previousCount+1);
				if(this.wheel_b() > 7)
				{
					this.wheel_b(0);
				};
				write_storage({"data":this.wheel_b(),"index":"B"});
			},
			decrementWheelB : function()
			{
				var previousCount = this.wheel_b();
				this.wheel_b(previousCount-1);
				if(this.wheel_b() < 0)
				{
					this.wheel_b(7);
				};
				write_storage({"data":this.wheel_b(),"index":"B"});
			},
			wheel_c : ko.observable(0),
			incrementWheelC : function()
			{
				var previousCount = this.wheel_c();
				this.wheel_c(previousCount+1);
				if(this.wheel_c() > 7)
				{
					this.wheel_c(0);
				};
				write_storage({"data":this.wheel_c(),"index":"C"});
			},
			decrementWheelC : function()
			{
				var previousCount = this.wheel_c();
				this.wheel_c(previousCount-1);
				if(this.wheel_c() < 0)
				{
					this.wheel_c(7);
				};
				write_storage({"data":this.wheel_c(),"index":"C"});
			},
			wheel_d : ko.observable(0),
			incrementWheelD : function()
			{
				var previousCount = this.wheel_d();
				this.wheel_d(previousCount+1);
				if(this.wheel_d() > 7)
				{
					this.wheel_d(0);
				};
				write_storage({"data":this.wheel_d(),"index":"D"});
			},
			decrementWheelD : function()
			{
				var previousCount = this.wheel_d();
				this.wheel_d(previousCount-1);
				if(this.wheel_d() < 0)
				{
					this.wheel_d(7);
				};
				write_storage({"data":this.wheel_d(),"index":"D"});
			},
		};
		
		function printout_B(myObj)
		{
			var wheels = {
			"A" : document.getElementById("Wheel_A"),
			"B" : document.getElementById("Wheel_B"),
			"C" : document.getElementById("Wheel_C"),
			"D" : document.getElementById("Wheel_D")};
			
			var w;
			for(w in wheels)
			{
				if(myObj[w]==0)
				{
					wheels[w].src = "wheelstones/wheelbirth.png";
				};
				if(myObj[w]==1)
				{
					wheels[w].src = "wheelstones/wheeldeath.png";
				};
				if(myObj[w]==2)
				{
					wheels[w].src = "wheelstones/wheelhealing.png";
				};
				if(myObj[w]==3)
				{
					wheels[w].src = "wheelstones/wheellove.png";
				};
				if(myObj[w]==4)
				{
					wheels[w].src = "wheelstones/wheelprotection.png";
				};
				if(myObj[w]==5)
				{
					wheels[w].src = "wheelstones/wheelreturn.png";
				};
				if(myObj[w]==6)
				{
					wheels[w].src = "wheelstones/wheelstrength.png";
				};
				if(myObj[w]==7)
				{
					wheels[w].src = "wheelstones/wheelwar.png";
				};
			};
		};
		
		function printout_A(myObj) 
		{
			var answer = {"A":2,"B":6,"C":7,"D":0};
			if(myObj["A"] == answer["A"] && myObj["B"] == answer["B"] && myObj["C"] == answer["C"] && myObj["D"] == answer["D"])
			{
				write_storage_S({"data":1,"index":"A"});
			}
			else
			{
				write_storage_S({"data":0,"index":"A"});
			};
			var images = {
			"A" : document.getElementById("Stone_1"),
			"B" : document.getElementById("Stone_2"),
			"C" : document.getElementById("Stone_3"),
			"D" : document.getElementById("Stone_4")};
			
			var i;
			for(i in images)
			{
				if(myObj[i]==0)
				{
					images[i].src = "greenstones/birth.png";
				};
				if(myObj[i]==1)
				{
					images[i].src = "greenstones/death.png";
				};
				if(myObj[i]==2)
				{
					images[i].src = "greenstones/healing.png";
				};
				if(myObj[i]==3)
				{
					images[i].src = "greenstones/love.png";
				};
				if(myObj[i]==4)
				{
					images[i].src = "greenstones/protection.png";
				};
				if(myObj[i]==5)
				{
					images[i].src = "greenstones/return.png";
				};
				if(myObj[i]==6)
				{
					images[i].src = "greenstones/strength.png";
				};
				if(myObj[i]==7)
				{
					images[i].src = "greenstones/war.png";
				};
			};
		};
		
		function printout_S(myObj)
		{
			var images = [
			document.getElementById("Stone_I1"),
			document.getElementById("Stone_I2")];
			if(myObj["A"]==0)
			{
				images[0].src = "lightstones/lightblack.png";
			};
			if(myObj["A"]==1)
			{
				images[0].src = "lightstones/lightwhite.png";
			};
			if(myObj["B"]==0)
			{
				images[1].src = "lightstones/lightblack.png";
			};
			if(myObj["B"]==1)
			{
				images[1].src = "lightstones/lightwhite.png";
			};
		};
		
		function init()
		{
			write_storage({"data":viewModel.wheel_a(),"index":"A"});
			write_storage({"data":viewModel.wheel_b(),"index":"B"});
			write_storage({"data":viewModel.wheel_c(),"index":"C"});
			write_storage({"data":viewModel.wheel_d(),"index":"D"});
		};
		
		ko.applyBindings(viewModel);
		init();
		var sleep = time => new Promise(resolve => setTimeout(resolve, time))
		var poll = (promiseFn, time) => promiseFn().then(
					 sleep(time).then(() => poll(promiseFn, time)))

		// Greet the World every second
		poll(() => new Promise(() => read_storage_A()), 50)
		poll(() => new Promise(() => read_storage_B()), 50)
		poll(() => new Promise(() => read_storage_S()), 50)
	</script>
	</body>
</html>