<?php
// src/views/components/editableField.php

function editableField($fieldName, $value, $isEditable = false) {
    $editableClass = $isEditable ? "editable" : "non-editable";
    $inputField = $isEditable ? "<input type='text' name='{$fieldName}' value='{$value}' class='form-control'>" : "<p>{$value}</p>";
    $editIcon = $isEditable ? "<span class='edit-icon'><i class='fas fa-pencil-alt'></i></span>" : "";
    
    return "
        <div class='editable-field {$editableClass}'>
            {$inputField}
            {$editIcon}
        </div>
    ";
}
?>
