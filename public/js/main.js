const flashMessageTimeout = 10000;

// Remove flash message after timeout
if (document.getElementById('msg-flash')) {
    setTimeout(function(){
        document.getElementById('msg-flash').remove();
    }, flashMessageTimeout);
};

// Delete Spending Item
function deleteSpendingItem(action){
    const deleteItemForm = document.getElementById('deleteSpendingItemModalForm');
    deleteItemForm.action = action;
};

