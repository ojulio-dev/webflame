const loaderAction = (action) => {

    if (action == 'show') {

        $('.component-loader').show();

    } else {

        $('.component-loader').hide();

    }

}

const readerImage = (userImage, imageInput) => {

    if (imageInput.files.length) {

        const reader = new FileReader();

        reader.readAsDataURL(imageInput.files[0]);

        reader.onload = () => {

            userImage.src = reader.result;
            
        }
    }

}