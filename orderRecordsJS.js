window.addEventListener('load', function () {
"use strict";
const form = document.getElementById("orderForm");

    //check to make sure text fields have been filled and at least one record is selected

    form.addEventListener("submit", function (event) {
        let failed = false;
        let checked = false;

        if(form.customerType.value == "ret") {
            if (form.forename.value == "") {
                failed = true;
                alert("please enter a forename.");
            } else if (form.surname.value == "") {
                failed = true;
                alert("please enter a surname.");
            }
        } else if (form.customerType.value == "trd") {
            if (form.companyName.value == "") {
                failed = true;
                alert("please enter a company name.");
            }
        } else if (form.customerType.value == "") {
            failed = true;
            alert("please select a type of customer.");
        }
        //select all checkboxes and check to see if any are checked if they are set checked to true and break the loop
        var checkboxes = selectRecords.querySelectorAll("input[type='checkbox']");
        let index;
        for (index = 0; index < checkboxes.length; index++) {
            const l_record = document.getElementsByName("record[]")[index];
            if (l_record.checked == true) {
                checked = true;
            }
        }
        //if there are no checkboxes checked show an alert asking the user to check a checkbox
        if (checked == false) {
            failed = true;
            alert("Please select at least one record.");
        }

        //prevent form from submitting if conditions are not met.
        if(failed == true) {
            event.preventDefault();
        }
    });

    const regCust = document.getElementById("retCustDetails");
    const tradeCust = document.getElementById("tradeCustDetails");
    const custValue = document.getElementsByName("customerType")[0];

    const l_text = document.getElementById("termsText");
    const agree = document.getElementsByName("termsChkbx")[0];

    const selectRecords = document.getElementById("selectRecords");
    const total = document.getElementsByName("total")[0];
    const orderButton = document.getElementsByName("submit")[0];

    let runningTotal = 0;
    let delivery = 0;
    let price = 0;

//display the relevant information required depending on type of customer.
    custValue.onchange = function () {
        if (custValue.value == "trd") {
            regCust.style.visibility = "hidden";
            tradeCust.style.visibility = "";
        }
        else if (custValue.value == "ret") {
            regCust.style.visibility = "";
            tradeCust.style.visibility = "hidden";
        }
        else {
            regCust.style.visibility = "hidden";
            tradeCust.style.visibility = "hidden";
        }
    };

//change style and colour of text when terms checkbox is checked.
    agree.onchange = function () {

        if (agree.checked == true) {
            l_text.style.color = "black";
            l_text.style.fontWeight = "";
            orderButton.disabled = false;

        }
        else {
            l_text.style.color = "#FF0000";
            l_text.style.fontWeight = "bold";
            orderButton.disabled = true;
        }
    };

//calculate total of records selected on change
    selectRecords.onchange = function () {
        let records = 0;
        let i;
        const val = selectRecords.querySelectorAll(".chosen");
        for (i = 0; i < val.length; i++) {
            const l_record = document.getElementsByName("record[]")[i];
            if (l_record.checked == true) {
                records += parseFloat(l_record.dataset.price);
            }
            runningTotal = records;
        }
        price = runningTotal + delivery;
        total.value=price;
    };

    const collection = document.getElementById("collection");

    //calculate total of records + delivery charge on change of delivery type selected
    collection.onchange = function () {
        let sum = 0;
        let i;
        const val = collection.querySelectorAll("input[type]");
        for (i = 0; i < val.length; i++) {
            const l_delivery = document.getElementsByName("deliveryType");
            if (l_delivery[i].checked) {
                sum += parseFloat(l_delivery[i].dataset.price);
            } else {
                sum += 0;
            }
            delivery = sum;
        }
        price = runningTotal + delivery;
        total.value=price;
    };

});