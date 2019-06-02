$(document).ready(function() {
    $('#Download').click(function() {

        var w = document.getElementById("pdf").offsetWidth;
        var h = document.getElementById("pdf").offsetHeight;


        html2canvas(document.getElementById("pdf"), {

            onrendered: function(canvas) {
                var img = canvas.toDataURL("image/jpeg", 1);
                var doc = new jsPDF('L', "mm", [w, h]);
                doc.addImage(img, 'JPEG', 0, 0);
                doc.save('factura.pdf');
            }
        });
    });
});