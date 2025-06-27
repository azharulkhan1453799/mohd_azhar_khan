$(document).ready(function() {
    $('#addBtn').click(function() {
        $('#addModal').show();
    });

    $('#addMemberForm').submit(function(e) {
        e.preventDefault();
        const name = $('#name').val().trim();
        const parentId = $('#parentId').val();

        if (name === '' || !/^[a-zA-Z ]+$/.test(name)) {
            alert("Enter a valid name (letters only)");
            return;
        }

        $.ajax({
            url: 'ajax/add_member.php',
            type: 'POST',
            dataType: 'json',
            data: { name: name, parentId: parentId },
            success: function(response) {
                if (response.success) {
                    let newNode = `<li data-id="${response.id}">${response.name}<ul></ul></li>`;
                    if (parentId) {
                        let parentLi = $('li[data-id="' + parentId + '"] > ul');
                        if (!parentLi.length) {
                            $('li[data-id="' + parentId + '"]').append("<ul></ul>");
                        }
                        $('li[data-id="' + parentId + '"] > ul').append(newNode);
                    } else {
                        $('#memberTree > ul').append(newNode);
                    }
                    $('#addModal').hide();
                    $('#addMemberForm')[0].reset();
                } else {
                    alert("Error saving member.");
                }
            }
        });
    });
});
