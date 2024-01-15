$('#registrationForm').bootstrapValidator({

    feedbackIcons: {

        valid: 'glyphicon glyphicon-ok',

        invalid: 'glyphicon glyphicon-remove',

        validating: 'glyphicon glyphicon-refresh'

    },

    fields: {

        nombre: {

            validators: {

                notEmpty: {

                    message: 'El nombre es requerido'

                }

            }

        },

        ap: {

            validators: {

                notEmpty: {

                    message: 'El apellido es requerido'

                }

            }

        },

        am: {

            validators: {

                notEmpty: {

                    message: 'El apellido es requerido'

                }

            }

        },

        email: {

            validators: {

                notEmpty: {

                    message: 'El correo es requerido y no puede ser vacio'

                },

                emailAddress: {

                    message: 'El correo electronico no es valido'

                }

            }

        },

        pass: {

            validators: {

                notEmpty: {

                    message: 'El password es requerido y no puede ser vacio'

                },

                stringLength: {

                    min: 8,

                    message: 'El password debe contener al menos 8 caracteres'

                }

            }

        },

    }

});