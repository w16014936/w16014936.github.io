function isNumberOrColon(e) {
    var charCode;
    if (e.keyCode > 0)
    {
        charCode = e.which || e.keyCode;
    }
    else if (typeof (e.charCode) != "undefined")
    {
        charCode = e.which || e.keyCode;
    }
    if (charCode == 58)
    {
        return true
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    {
        return false;
    }
    return true;
}