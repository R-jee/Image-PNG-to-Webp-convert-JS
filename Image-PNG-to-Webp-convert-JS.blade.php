<canvas id="canvas" style="display:none;"></canvas>

<script>

const canvas = document.getElementById('canvas'); // Ensure the canvas is defined

    function convertImageToWebP(image) {
        const ctx = canvas.getContext('2d');

        // Set canvas dimensions based on the image
        canvas.width = image.naturalWidth || image.parentNode.clientWidth; // Use naturalWidth for accurate size
        canvas.height = image.naturalHeight || image.parentNode.clientHeight; // Use naturalHeight for accurate size

        // Draw the image on the canvas
        ctx.drawImage(image, 0, 0);

        // Convert canvas to WebP blob
        canvas.toBlob(function (blob) {
            if (blob) { // Check if blob is valid
                const webpUrl = URL.createObjectURL(blob);
                console.log('WebP image URL:', webpUrl);
                image.src = webpUrl;
            } else {
                console.error('Canvas toBlob failed to create a blob.');
            }
        }, 'image/webp', 1);
    }

    // Once the image is loaded, trigger conversion to WebP
    $('.fr-slide-img img, .frontend-menu-card-img-top img, .fr-review-card img, .fr-product-card img').each(function (index, node) {
        if (node instanceof HTMLImageElement) {
            // Set CORS attribute
            $(node).attr('crossOrigin', 'anonymous');

            const onLoadHandler = () => {
                convertImageToWebP(node);
                node.onload = null; // Remove the onload handler after conversion
            };
            if (node.complete) {
                onLoadHandler();
            } else {
                node.onload = onLoadHandler;
            }
        }
    });

</script>
