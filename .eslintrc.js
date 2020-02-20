module.exports = {
  env: {
    browser: true,
    commonjs: true,
    es6: true,
    node: true
  },
  extends: ["eslint:recommended", "wordpress"],
  parserOptions: {
    sourceType: "module"
  },
  rules: {
    // indent: ["error", "2 spaces"],
    "space-in-parens": ["error", "never"],
    "no-trailing-spaces": ["error", { "ignoreComments": true }],
    quotes: ["error", "single"],
    semi: ["error", "always"],
    "linebreak-style": 0
  }
};
