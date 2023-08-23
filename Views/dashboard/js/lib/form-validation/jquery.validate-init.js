
var form_validation = function() {
    var e = function() {
            jQuery(".form-valide").validate({
                ignore: [],
                errorClass: "invalid-feedback animated fadeInDown",
                errorElement: "div",
                errorPlacement: function(e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },
                rules: {
                    "nombre-entidad": {
                        required: !0,
                        minlength: 5
                    },
                    "alias-entidad": {
                        required: !0,
                        minlength: !0
                    },
                    "eslogan-entidad": {
                        required: !0,
                        minlength: 5
                    },
                    "direccion-entidad": {
                        required: !0,
                        minlength: 2
                    },
                    "telefono-entidad": {
                        required: !0,
                        minlength: 5
                    },
                    "email-entidad": {
                        required: !0,
                        minlength: 5
                    },
                    "responsable-entidad": {
                        required: !0,
                        minlength: 5
                    },
                    
                    "telefono-responsable": {
                        required: !0,
                        minlength: 5
                    }
                    
                },
                messages: {
                    "nombre-entidad": {
                        required: "Por favor ingresar nombre de la Entidad",
                        minlength: "Debe tener mínimo 5 caracteres"
                    },
                    "alias-entidad": {
                        required: "Por favor ingresar alias de la Entidad",
                        minlength: "Debe tener mínimo 5 caracteres"
                    },
                    "eslogan-entidad": {
                        required: "Por favor ingresar eslogan de la Entidad",
                        minlength: "Debe tener mínimo 5 caracteres"
                    },
                    "direccion-entidad": {
                        required: "Por favor ingresar dirección de la Entidad",
                        minlength: "Debe tener mínimo 5 caracteres"
                    },
                    "telefono-entidad": {
                        required: "Por favor ingresar teléfono de la Entidad",
                        minlength: "Debe tener mínimo 5 caracteres"
                    },
                    "email-entidad": {
                        required: "Por favor ingresar email de la Entidad",
                        minlength: "Debe tener mínimo 5 caracteres"
                    },
                    "responsable-entidad": {
                        required: "Por favor ingresar responsable de la Entidad",
                        minlength: "Debe tener mínimo 5 caracteres"
                    },
                    "telefono-responsable": {
                        required: "Por favor ingresar teléfono del responsable de la Entidad",
                        minlength: "Debe tener mínimo 5 caracteres"
                    }
                }
            })
        }
    return {
        init: function() {
            e(), a(), jQuery(".js-select2").on("change", function() {
                jQuery(this).valid()
            })
        }
    }
}();
jQuery(function() {
    form_validation.init()
});