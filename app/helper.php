<?php  

function status($status){
    if($status == "A"){
        echo '<span class="text-white p-2 badge bg-primary">Active</span>';
    }else if($status == "P"){
        echo '<span class="text-white p-2 badge bg-warning">Pending</span>';
    }else if($status == "B"){
        echo '<span class="text-white p-2 badge bg-danger">Block</span>';
    }else{
        return 'N/A';
    }
}


function dateFormat($date){
    echo date('d , F y' , strtotime($date));
  }

  function PurposeName($purpose){
    if($purpose == "S"){
        return 'Sell';
    }else if($purpose == "B"){
        return 'Buy';
    }else if($purpose == "R"){
        return 'Rent';
    }else{
        return "N/A";
    }
  }

  function cityName($city){
    if($city == "I"){
        return 'Islamabad';
    }else if($city == "R"){
        return 'Rawalpindi';
    }else if($city == "L"){
        return 'Lahore';
    }else if($city == "K"){
        return 'karachi';
    }else if($city == "F"){
        return 'Faisalabad';
    }else if($city == "M"){
        return 'Multan';
    }else{
        return "N/A";
    }
  }

  
?>