import globals from "globals";
import pluginJs from "@eslint/js";

export default [
    {
        ignores: [
            "assets/modules/swiper/**",
            "assets/dist/**",
        ],
    },
    {languageOptions: {globals: globals.browser}},
    pluginJs.configs.recommended,
];
