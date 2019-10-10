//Check Role

//Check all permission
function checkAll(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
//Check permission children
function checkChildren(id, source) {
    var checkboxes = document.querySelectorAll('.check_children_'+id);
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source){
            checkboxes[i].checked = source.checked;
            if (source.checked){
                if ($('#chirent_key_'+id).hasClass("chirent_key_none"))
                    $("#chirent_key_"+id).addClass('chirent_key_block').removeClass("chirent_key_none")
            }
        }
    }
    checkAllChildrenCheckParent(id)
}
//Check permission item children
function checkItemChildren(id, parent, source)
{
    if ((source.target).tagName == 'input') return true; 
    $("#permission_check_"+id).prop("checked", !$("#permission_check_"+id).prop("checked"));
    checkAllChildrenCheckParent(parent);
}
//Check permission item parent not children
function checkItemParentNotChildren(parent, source)
{
    if ((source.target).tagName == 'input') return true; 
    $("#permission_check_parent"+parent).prop("checked", !$("#permission_check_parent"+parent).prop("checked"));
    checkAllChildrenCheckParent(parent);
}
//Dropdown permission
function toggleRole(id)
{
    var element = document.getElementById("chirent_key_"+id);
    element.classList.toggle("chirent_key_none");
    if ($('#folder_'+id).hasClass("fa-folder-open"))
        $('#folder_'+id).addClass("fa-folder").removeClass("fa-folder-open");
    else
        $('#folder_'+id).addClass("fa-folder-open").removeClass("fa-folder");
}
function checkAllChildrenCheckParent(parent)
{
    if ($(".checkbox_checked_"+parent).length == $(".checkbox_checked_"+parent+":checked").length) {
      $("#parent_"+parent).prop("checked", true);
    } 
    else {
      $("#parent_"+parent).prop("checked", false);
    }
    if ($(".checkboxs").length == $(".checkboxs:checked").length) {
      $(".checkAll").prop("checked", true);
    } 
    else {
      $(".checkAll").prop("checked", false);
    }
}
