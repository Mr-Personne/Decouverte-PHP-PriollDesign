var rowIndex = 0;
var direction = 1;
var displayX;

window.addEventListener("load", function () {
    var button = document.querySelector("#load-more");
    var hiddenRows = document.querySelectorAll("#portfolio .row.d-none");
    //console.log("hiddenrows : ",hiddenRows)


    button.addEventListener("click", function () {
        console.log("index : ", rowIndex);
        checkRowIndex(rowIndex);
        console.log("after check index: ", rowIndex);
    });




    function checkRowIndex(i) {
        //showMoreLess(i, direction);
        console.log("hiddenRows start: ",hiddenRows);
        
        if (direction == -1) {
            for (let items of hiddenRows){
                items.classList.remove("d-flex");
            }
            document.querySelector("#load-more p").innerText = "LOAD MORE WORK";
            direction = 1;
            rowIndex=0;
            console.log("hiddenRows after -1d: ",hiddenRows);
            return
        }
        if (direction == 1) {
            console.log("showmore",rowIndex);
            hiddenRows[rowIndex].classList.add("d-flex");
            rowIndex = rowIndex + 1;
            if (rowIndex == hiddenRows.length) {
                document.querySelector("#load-more p").innerText = "SHOW LESS WORK";
                direction = -1;
            }
        }
    };

});

