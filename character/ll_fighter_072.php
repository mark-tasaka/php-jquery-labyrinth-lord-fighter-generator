<!DOCTYPE html>
<html>
<head>
<title>Labyrinth Lord Fighter Character Generator</title>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
	<meta charset="UTF-8">
	<meta name="description" content="Labyrinth Lord Fighter Character Generator. Goblinoid Games.">
	<meta name="keywords" content="Labyrinth Lord, Goblinoid Games,HTML5,CSS,JavaScript">
	<meta name="author" content="Mark Tasaka 2018">
		

	<link rel="stylesheet" type="text/css" href="css/ll_fighter.css">
	<link rel="stylesheet" type="text/css" href="css/ll_fighter_post.css">
    
    
    <script type="text/javascript" src="./js/dieRoll.js"></script>
    <script type="text/javascript" src="./js/modifiers.js"></script>
    <script type="text/javascript" src="./js/hitPoinst.js"></script>
    <script type="text/javascript" src="./js/primeReq.js"></script>
    
    
    
</head>
<body>
    
    <!--PHP-->
    <?php
    
    include 'php/armour.php';
    include 'php/checks.php';
    include 'php/weapons.php';
    include 'php/gear.php';
    include 'php/coins.php';
    include 'php/encumbrance.php';
    
    
        if(isset($_POST["theCharacterName"]))
        {
            $characterName = $_POST["theCharacterName"];
    
        }
    
        if(isset($_POST["thePlayerName"]))
        {
            $playerName = $_POST["thePlayerName"];
        
        }    
    
        if(isset($_POST["theAlignment"]))
        {
            $alignment = $_POST["theAlignment"];
        }
    
        if(isset($_POST["theArmour"]))
        {
            $armour = $_POST["theArmour"];
        }
    
        $armourName = getArmour($armour)[0];
        $armourDefense = getArmour($armour)[1];
        $armourWeight = getArmour($armour)[2];
    
        if(isset($_POST["theShield"]))
        {
            $shield = $_POST["theShield"];
        }
    
        $shieldName = getShield($shield)[0];
        $shieldDefense = getShield($shield)[1];
        $shieldWeight = getShield($shield)[2];
    
        $totalAcDefense = $armourDefense + $shieldDefense;
        $totalArmourWeight = $shieldWeight + $armourWeight;
    
        $armourDefense = removeZero($armourDefense);
        $armourWeight = removeZero($armourWeight);
    
        $shieldDefense = removeZero($shieldDefense);
        $shieldWeight = removeZero($shieldWeight);
    
        if(isset($_POST["theGold"]))
        {
            $coins = $_POST["theGold"];
        }
    
        $coinQuantity = getCoins($coins)[0];
        $coinType = getCoins($coins)[1];
    
    
         
        $weaponArray = array();
        $weaponNames = array();
        $weaponDamage = array();
        $weaponWeight = array();
    
    
        if(isset($_POST["theWeapons"]))
        {
            foreach($_POST["theWeapons"] as $weapon)
            {
                array_push($weaponArray, $weapon);
            }
        }
    
    foreach($weaponArray as $select)
    {
        array_push($weaponNames, getWeapon($select)[0]);
    }
        
    foreach($weaponArray as $select)
    {
        array_push($weaponDamage, getWeapon($select)[1]);
    }
        
    $totalWeaponWeight = 0;
    
    foreach($weaponArray as $select)
    {
        array_push($weaponWeight, getWeapon($select)[2]);
        $totalWeaponWeight += getWeapon($select)[2];
    }
    
    

        $gearArray = array();
        $gearNames = array();
        $gearWeight = array();
    
    
        if(isset($_POST["theGear"]))
        {
            foreach($_POST["theGear"] as $weapon)
            {
                array_push($gearArray, $weapon);
            }
        }
    
        foreach($gearArray as $select)
        {
            array_push($gearNames, getGear($select)[0]);
        }
        
        $totalGearWeight = 0;
    
        foreach($gearArray as $select)
        {
            array_push($gearWeight, getGear($select)[1]);
            $totalGearWeight += getGear($select)[1];
        }
    
    $totalWeightCarried = $totalArmourWeight + $totalWeaponWeight + $totalGearWeight + $coinQuantity;
    
    $movementTurn = turnMovement($totalWeightCarried);
    
    $movementEncounter = encounterMovement($totalWeightCarried);
    
    $movementRunning = runningMovement($totalWeightCarried);
    
    
    
    ?>

    
	
<!-- JQuery -->
  <img id="character_sheet"/>
   <section>
           
		<span id="strength"></span>
		<span id="dexterity"></span> 
		<span id="constitution"></span> 
		<span id="intelligence"></span>
		<span id="wisdom"></span>
       <span id="charisma"></span>
		  
       
		<span id="strengthModDesc"></span>
		<span id="dexterityModDesc"></span> 
		<span id="constitutionModDesc"></span> 
		<span id="intelligenceModDesc"></span>
		<span id="wisdomModDesc"></span>
       <span id="charismaModDesc"></span>
       
       <span id="saveBreathAttack"></span>
       <span id="savePoisonDeath"></span>
       <span id="savePetrify"></span>
       <span id="saveWands"></span>
       <span id="saveSpell"></span>
       
       <span id="dieRollMethod"></span>
       
       <span id="level"></span>
       <span id="class">Fighter</span>
       <span id="exNextLevel"></span>
       
       <span id="meleeAc0"></span>
       <span id="meleeAc1"></span>
       <span id="meleeAc2"></span>
       <span id="meleeAc3"></span>
       <span id="meleeAc4"></span>
       <span id="meleeAc5"></span>
       <span id="meleeAc6"></span>
       <span id="meleeAc7"></span>
       <span id="meleeAc8"></span>
       <span id="meleeAc9"></span>
       
       <span id="missileAc0"></span>
       <span id="missileAc1"></span>
       <span id="missileAc2"></span>
       <span id="missileAc3"></span>
       <span id="missileAc4"></span>
       <span id="missileAc5"></span>
       <span id="missileAc6"></span>
       <span id="missileAc7"></span>
       <span id="missileAc8"></span>
       <span id="missileAc9"></span>
       
       <span id="baseAc"></span>
       <span id="hitPoints"></span>
       <span id="primeReq"></span>
       <span id="modifiedAc"></span>
       <span id="addAttack"></span>
       
       <span id="characterName">
           <?php
                echo $characterName;
           ?>
        </span>
       
              
       <span id="playerName">
           <?php
                echo $playerName;
           ?>
        </span>
	                 
       <span id="alignment">
           <?php
                echo $alignment;
           ?>
        </span>
              
       <span id="armourName">
           <?php
                echo $armourName;
           ?>
        </span>
              
       <span id="armourAc">
           <?php
                echo $armourDefense;
           ?>
        </span>
              
       <span id="armourWeight">
           <?php
                echo $armourWeight;
           ?>
        </span>
       
              
       <span id="shieldName">
           <?php
                echo $shieldName;
           ?>
        </span>
              
       <span id="shieldAc">
           <?php
                echo $shieldDefense;
           ?>
        </span>
              
       <span id="shieldWeight">
           <?php
                echo $shieldWeight;
           ?>
        </span>
              
       <span id="totalArmourWeight">
            <?php
                echo $totalArmourWeight;
            ?>
       </span>
              
       <span id="totalArmourClassMod">
            <?php
                echo $totalAcDefense;
            ?>
       </span>
       
       <span id="weaponsList">
           <?php
           $val1 = 0;
           $val2 = 0;
           $val3 = 0;
           
           foreach($weaponNames as $theWeapon)
           {
               echo $theWeapon;
               echo "<br/>";
               $val1 = isWeaponTwoHanded($theWeapon, $val1);
               $val2 = isWeaponBastardSword($theWeapon, $val2);
           }
           
           $val3 = $val1 + $val2;
           
           $weaponNotes = weaponNotes($val3);
           
           ?>  
        </span>
       
       <span id="weaponNotes">
           <?php
                echo $weaponNotes;
           ?>
        </span>
            
       <span id="weaponsList2">
           <?php
           foreach($weaponDamage as $theWeaponDam)
           {
               echo $theWeaponDam;
               echo "<br/>";
           }
           ?>        
        </span>
       

            
       <span id="weaponsList3">
           <?php
           foreach($weaponWeight as $theWeapon)
           {
               echo $theWeapon;
               echo "<br/>";
           }
           ?>        
        </span>
       
       <span id="totalWeaponWeight">
           <?php
           echo $totalWeaponWeight;
           ?>
       </span>

              
       <span id="gearList">
           <?php
           
           foreach($gearNames as $theGear)
           {
               echo $theGear;
               echo "<br/>";
           }
           ?>
       </span>
           
              
       <span id="gearList2">
           <?php
           
           foreach($gearWeight as $theGear)
           {
               echo $theGear;
               echo "<br/>";
           }
           ?>  
        </span>
	   	   
       
       <span id="totalGearWeight">
           <?php
           echo $totalGearWeight;
           ?>
       </span>
       
       
       
       <span id="totalWeightCarried">
           <?php
           echo $totalWeightCarried . " lbs";
           ?>
       </span>
              
       
       <span id="wealth">
           <?php
           echo ($coinQuantity * 10) . $coinType;
           ?>
       </span>
       
       <span id="coinWeight">
           <?php
           echo $coinQuantity . " lbs";
           ?>
       </span>
       
              
       <span id="turnMove">
           <?php
           echo $movementTurn;
           ?>
       </span>
       
       
       <span id="encounterMove">
           <?php
           echo $movementEncounter;
           ?>
       </span>
       
       <span id="runningMove">
           <?php
           echo $movementRunning;
           ?>
       </span>
       
       
	</section>
	

		
  <script>
      

	  
	/*
	 Character() - Fighter Character Constructor
	*/
	function Character() {

        let strength = rollDice(6, 4, 1, 0);
        let dexterity = rollDice(6, 4, 1, 0);
        let constitution = rollDice(6, 4, 1, 0);
        let	intelligence = rollDice(6, 4, 1, 0);
        let	wisdom = rollDice(6, 4, 1, 0);
        let	charisma = rollDice(6, 4, 1, 0);
        let wisdomMod = abilityScoreModifier(wisdom);
        let strengthMod = abilityScoreModifier(strength);
        let dexterityMod = abilityScoreModifier(dexterity);
        let constitutionMod = abilityScoreModifier(constitution);
        let fighter = getFighter();
		
		let fighterCharacter = {
			"strength": strength,
			"dexterity": dexterity,
			"constitution": constitution,
			"intelligence": intelligence,
			"wisdom": wisdom,
			"charisma": charisma,
            "strengthMod": abilityScoreModifier(strength),
            "strengthModifyDes": strengthModifierDescription(strength),
            "dexterityMod": abilityScoreModifier(dexterity),
            "dexterityModifyDes": dexterityModifierDescription(dexterity),
            "constitutionMod": abilityScoreModifier(constitution),
            "constitutionModifyDes": constitutionModifierDescription(constitution),
            "intelligenceMod": abilityScoreModifier(intelligence),
            "intelligenceModifyDes": intelligenceModifierDescription(intelligence),
            "wisdomModifyDes": wisdomModifierDescription(wisdom),
            "charismaMod": abilityScoreModifier(charisma),
            "charismaModifyDes": charismaModifierDescription(charisma),
            "breathAttack": fighter.breathAttack,
            "poisonDeath": fighter.poisonDeath,
            "petrify": fighter.petrify,
            "wandsSave": fighter.wand - wisdomMod,
            "spellSave": fighter.spell - wisdomMod,
            "level": fighter.level,
            "nextLevelExp": fighter.exNext,
            "meleeHitAC0": fighter.thaco - (strengthMod),
            "meleeHitAC1": fighter.thaco - (strengthMod) - 1,
            "meleeHitAC2": fighter.thaco - (strengthMod) - 2,
            "meleeHitAC3": fighter.thaco - (strengthMod) - 3,
            "meleeHitAC4": fighter.thaco - (strengthMod) - 4,
            "meleeHitAC5": fighter.thaco - (strengthMod) - 5,
            "meleeHitAC6": fighter.thaco - (strengthMod) - 6,
            "meleeHitAC7": fighter.thaco - (strengthMod) - 7,
            "meleeHitAC8": fighter.thaco - (strengthMod) - 8,
            "meleeHitAC9": fighter.thaco - (strengthMod) - 9,
            "missileHitAC0": fighter.thaco - (dexterityMod),
            "missileHitAC1": fighter.thaco - (dexterityMod) - 1,
            "missileHitAC2": fighter.thaco - (dexterityMod) - 2,
            "missileHitAC3": fighter.thaco - (dexterityMod) - 3,
            "missileHitAC4": fighter.thaco - (dexterityMod) - 4,
            "missileHitAC5": fighter.thaco - (dexterityMod) - 5,
            "missileHitAC6": fighter.thaco - (dexterityMod) - 6,
            "missileHitAC7": fighter.thaco - (dexterityMod) - 7,
            "missileHitAC8": fighter.thaco - (dexterityMod) - 8,
            "missileHitAC9": fighter.thaco - (dexterityMod) - 9,
            "acBase": 9 - dexterityMod,
            "acModified": <?php echo $totalAcDefense ?> + 9 - dexterityMod,
            "hp": hitPoints(fighter.hd, constitutionMod) + addHighLevelHp(fighter.level),
            "secondAttack": secondAttack(fighter.level),
            "primeReqBonus": primeReq(strength),
			"dieRollMethod": "Ability Score Generation: 4d6, drop the lowest"
			
		
			

		};
	    if(fighterCharacter.hitPoints <= 0 ){
			fighterCharacter.hitPoints = 1;
		}
		return fighterCharacter;
	  
	  }
	  

      
    /*getFighter() return the statistics for the Fighter per level*/  
    function getFighter() {
	let fighter = [
        
		{"level": 1,
		 "thaco": 19,
		 "breathAttack": 15,
		 "poisonDeath": 12,
		 "petrify": 14,
		 "wand": 13,
		 "spell": 16,
         "exNext": "2,035",
         "hd": 1
        },
        
		{"level": 2,
		 "thaco": 19,
		 "breathAttack": 15,
		 "poisonDeath": 12,
		 "petrify": 14,
		 "wand": 13,
		 "spell": 16,
         "exNext": "4,065",
         "hd": 2
        },
        
		{"level": 3,
		 "thaco": 18,
		 "breathAttack": 15,
		 "poisonDeath": 12,
		 "petrify": 14,
		 "wand": 13,
		 "spell": 16,
         "exNext": "8,125",
         "hd": 3
        },
        
		{"level": 4,
		 "thaco": 17,
		 "breathAttack": 13,
		 "poisonDeath": 10,
		 "petrify": 12,
		 "wand": 11,
		 "spell": 14,
         "exNext": "16,251",
         "hd": 4
        },
        
		{"level": 5,
		 "thaco": 16,
		 "breathAttack": 13,
		 "poisonDeath": 10,
		 "petrify": 12,
		 "wand": 11,
		 "spell": 14,
         "exNext": "32,501",
         "hd": 5
        },
        
		{"level": 6,
		 "thaco": 15,
		 "breathAttack": 13,
		 "poisonDeath": 10,
		 "petrify": 12,
		 "wand": 11,
		 "spell": 14,
         "exNext": "65,001",
         "hd": 6
        },
        
		{"level": 7,
		 "thaco": 14,
		 "breathAttack": 9,
		 "poisonDeath": 8,
		 "petrify": 10,
		 "wand": 9,
		 "spell": 12,
         "exNext": "120,001",
         "hd": 7
        },
        
		{"level": 8,
		 "thaco": 14,
		 "breathAttack": 9,
		 "poisonDeath": 8,
		 "petrify": 10,
		 "wand": 9,
		 "spell": 12,
         "exNext": "240,001",
         "hd": 8
        },
        
		{"level": 9,
		 "thaco": 13,
		 "breathAttack": 9,
		 "poisonDeath": 8,
		 "petrify": 10,
		 "wand": 9,
		 "spell": 12,
         "exNext": "360,001",
         "hd": 9
        },
        
		{"level": 10,
		 "thaco": 12,
		 "breathAttack": 7,
		 "poisonDeath": 6,
		 "petrify": 8,
		 "wand": 7,
		 "spell": 10,
         "exNext": "480,001",
         "hd": 9
        },
        
		{"level": 11,
		 "thaco": 12,
		 "breathAttack": 7,
		 "poisonDeath": 6,
		 "petrify": 8,
		 "wand": 7,
		 "spell": 10,
         "exNext": "600,001",
         "hd": 9
        },
        
		{"level": 12,
		 "thaco": 11,
		 "breathAttack": 7,
		 "poisonDeath": 6,
		 "petrify": 8,
		 "wand": 7,
		 "spell": 10,
         "exNext": "720,001",
         "hd": 9
        },
        
		{"level": 13,
		 "thaco": 10,
		 "breathAttack": 5,
		 "poisonDeath": 4,
		 "petrify": 6,
		 "wand": 5,
		 "spell": 8,
         "exNext": "840,001",
         "hd": 9
        },
        
		{"level": 14,
		 "thaco": 9,
		 "breathAttack": 5,
		 "poisonDeath": 4,
		 "petrify": 6,
		 "wand": 5,
		 "spell": 8,
         "exNext": "960,001",
         "hd": 9
        },
        
		{"level": 15,
		 "thaco": 8,
		 "breathAttack": 5,
		 "poisonDeath": 4,
		 "petrify": 6,
		 "wand": 5,
		 "spell": 8,
         "exNext": "1,080,001",
         "hd": 9
        }
        

		
	];
	
	
	return fighter[6]; 
}

  
       let imgData = "images/fighter_character_sheet.png";
      
        $("#character_sheet").attr("src", imgData);
      

	  let data = Character();
		 
      $("#strength").html(data.strength);
      
      $("#dexterity").html(data.dexterity);
      
      $("#constitution").html(data.constitution);
      
      $("#intelligence").html(data.intelligence);
      
      $("#wisdom").html(data.wisdom);
      
      $("#charisma").html(data.charisma);
      
      $("#strengthModDesc").html(data.strengthModifyDes);
      $("#dexterityModDesc").html(data.dexterityModifyDes);
      $("#constitutionModDesc").html(data.constitutionModifyDes);
      $("#intelligenceModDesc").html(data.intelligenceModifyDes);
      $("#wisdomModDesc").html(data.wisdomModifyDes);
      $("#charismaModDesc").html(data.charismaModifyDes);
      
      $("#saveBreathAttack").html(data.breathAttack);
      $("#savePoisonDeath").html(data.poisonDeath);
      $("#savePetrify").html(data.petrify);
      $("#saveWands").html(data.wandsSave);
      $("#saveSpell").html(data.spellSave);
      
      $("#dieRollMethod").html(data.dieRollMethod);
      
      $("#level").html(data.level);
      $("#exNextLevel").html(data.nextLevelExp);
      
      $("#meleeAc0").html(data.meleeHitAC0);
      $("#meleeAc1").html(data.meleeHitAC1);
      $("#meleeAc2").html(data.meleeHitAC2);
      $("#meleeAc3").html(data.meleeHitAC3);
      $("#meleeAc4").html(data.meleeHitAC4);
      $("#meleeAc5").html(data.meleeHitAC5);
      $("#meleeAc6").html(data.meleeHitAC6);
      $("#meleeAc7").html(data.meleeHitAC7);
      $("#meleeAc8").html(data.meleeHitAC8);
      $("#meleeAc9").html(data.meleeHitAC9);
      
      $("#missileAc0").html(data.missileHitAC0);
      $("#missileAc1").html(data.missileHitAC1);
      $("#missileAc2").html(data.missileHitAC2);
      $("#missileAc3").html(data.missileHitAC3);
      $("#missileAc4").html(data.missileHitAC4);
      $("#missileAc5").html(data.missileHitAC5);
      $("#missileAc6").html(data.missileHitAC6);
      $("#missileAc7").html(data.missileHitAC7);
      $("#missileAc8").html(data.missileHitAC8);
      $("#missileAc9").html(data.missileHitAC9);
      
      $("#baseAc").html(data.acBase);
      $("#hitPoints").html(data.hp);
      $("#primeReq").html(data.primeReqBonus);
      $("#modifiedAc").html(data.acModified);
      $("#addAttack").html(data.secondAttack);

	 
  </script>
		
	
    
</body>
</html>