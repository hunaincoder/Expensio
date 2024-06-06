<?php
include('header.php');
checkUser();
userArea();
include('user_header.php');
?>
	<div class="navbar">
<h2 id="dashboard">Dashboard</h2>
</div>

<div class="body-dashboard">
  <div class="container-dashboard">
    <div class="card">
      <h2 class="h-d">Today's Expense</h2>
      <p class="p-d" style="font-size: larger;"><?php echo getDashboardExpense('today')?></p>
    </div>
    <div class="card">
      <h2 class="h-d">Yesterday's Expense</h2>
      <p class="p-d" style="font-size: larger;"><?php echo getDashboardExpense('yesterday')?></p>
    </div>
    <div class="card">
      <h2 class="h-d">This Week Expense</h2>
      <p class="p-d" style="font-size: larger;"><?php echo getDashboardExpense('week')?></p>
    </div>
    <div class="card">
      <h2 class="h-d">This Month Expense</h2>
      <p class="p-d" style="font-size: larger;"><?php echo getDashboardExpense('month')?></p>
    </div>
    <div class="card">
      <h2 class="h-d">This Year Expense</h2>
      <p class="p-d" style="font-size: larger;">
	  <?php echo getDashboardExpense('year')?></p>
    </div>
    <div class="card">
      <h2 class="h-d">Total Expense</h2>
	  <p class="p-d" style="font-size: larger;"><?php echo getDashboardExpense('total')?></p>

    </div>
  </div>
</div>


<style>
	.h-d
	{
		position: relative;
		text-align:center;
	}
	.p-d{
		position: relative;
		text-align:center;
	margin-top: 20px;


	}
	      .body-dashboard {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: white;
            margin-left: 16%;
        }

        .navbar {
            text-align: center;
            width: 100%;
        }
	

        .navbar h2 {
            margin: 0;
            font-size: 36px;
            text-align: center;
        }

        .container-dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 900px;
        }

        .card {
            box-sizing: border-box;
            width: 380px; 
            height: 150px; 
            margin-bottom: 40px;
            padding: 20px;
            color: white;
            font-size: 24px; 
            border-radius: 10px;
            box-shadow: 0px 10px 10px rgba(0,0,0,0.1);
        }

        .card h2 {
            margin: 0;
            font-size: 28px; 
            font-weight: bold;
        }

        .card p {
            font-size: 20px;
        }

        .card:nth-child(1) {
            background-color: #656ed3;
        }

        .card:nth-child(2) {
            background-color: #656ed3;
        }

        .card:nth-child(3) {
            background-color: #656ed3;
        }

        .card:nth-child(4) {
            background-color: #656ed3;
        }

        .card:nth-child(5) {
            background-color: #656ed3;
        }

        .card:nth-child(6) {
            background-color: #656ed3;
        }
		.detail-button {
    padding: 8px 16px;
    background-color: #afb3ff; 
    color: white; 
    border: none; 
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
   
    cursor: pointer; 
  }

  .detail-button:hover {
    background-color: #656ed3;
  }
</style>
