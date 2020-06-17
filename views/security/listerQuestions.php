<div class="container p-3 w-100 color5 col-8 m-auto rounded shadow bg-white d-flex flex-column justify-content-space-between align-items-stretch" style="height: 95%;">
    <span class="w-100 text-center">
        <form action="" method="post">
            <div class="form-group">
                <label for="questionNumberPerGame" class="d-inline col-3" style="font-size: 14pt;">Nbre de question/Jeu</label>
                <input type="text" name="questionNumberPerGame" id="questionNumberPerGame" class="form-control d-inline col-1" placeholder="" aria-describedby="helpId">
                <button type="submit" name="btn_submit" class="btn utile4 rounded shadow text-white col-1">OK</button>
            </div>
        </form>
    </span>
    <div class="m-2 p-2 h-75 border border-primary rounded" id="questionsContainer" style="font-size: 15pt;">
        <?php

$questionsManager = new QuestionsManager();
$reponseManager = new ReponseManager();

if(count($questionsManager->findAll()) > 0){
   $questions = $questionsManager->findAll();
   
foreach($questions as $question){
echo $question->getIdQuestions().'<br />';
echo $question->getLibelleQuestion().'<br />';
echo $question->getPoints().'<br />';
}

} else {
   $this->data['questionNull'] = "Vous n'avez pas encore créé de questions";
}




        if (isset($questionNull)) {
        ?>
            <div class="utile3 rounded p-2 text-center col-5 my-3 mx-auto"><?= $questionNull ?></div>
        <?php
        }
        ?>
    </div>
    <div class="w-100">
        <button type="button" name="" value="" class="btn utile3  float-right border-utile1 text-white font-weight-bold shadow-sm">Suivant</button>
    </div>

</div>

<script type="text/javascript">
var questionsContainer = document.getElementById("questionsContainer");
console.log(questionsContainer.nodeValue);
</script>