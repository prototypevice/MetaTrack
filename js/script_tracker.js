function openDrawer() {
    document.getElementById("drawer").style.right = "0";
}
function closeDrawer() {
    document.getElementById("drawer").style.right = "-400px";
}
function openIntakeDrawer() {
    document.getElementById("intakeDrawer").style.left = "0";
}
function closeIntakeDrawer() {
    document.getElementById("intakeDrawer").style.left = "-400px";
}
function showNutrition(food) {
    document.getElementById("nutritionDetails").innerHTML =
        "<strong>" + food.name + "</strong><br>" +
        "Calories: " + food.calories + " kcal<br>" +
        "Protein: " + food.protein + "g<br>" +
        "Fat: " + food.fat + "g<br>" +
        "Carbs: " + food.carbs + "g";
    document.getElementById("foodInput").value = food.name;
    document.getElementById("nutritionDrawer").style.right = "0";
}
function closeNutritionDrawer() {
    document.getElementById("nutritionDrawer").style.right = "-300px";
}
function filterFoods() {
    var input = document.getElementById("foodSearch").value.toLowerCase();
    var items = document.querySelectorAll(".food-btn");
    items.forEach(function(btn) {
        btn.style.display = btn.getAttribute("data-name").includes(input) ? "block" : "none";
    });
}
window.onload = function() {
    if (window.location.hash === "#intake") {
        openIntakeDrawer();
    }
};
