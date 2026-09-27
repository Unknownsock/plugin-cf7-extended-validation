# CF7 Extended Validation

A WordPress plugin that extends [Contact Form 7](https://cf7.wp-plugin.org/) with enhanced submit button handling, loading states, and improved user feedback.

This repository is the development environment for the plugin: source assets, build tooling, and a local WordPress dev setup live here, while the shippable plugin itself lives in [`plugin/cf7-extended-validation`](plugin/cf7-extended-validation).

See [`plugin/cf7-extended-validation/README.md`](plugin/cf7-extended-validation/README.md) for plugin features, installation, and usage.

## Development

```bash
npm install
npm run build     # builds plugin assets to plugin/cf7-extended-validation/dist
npm run package    # zips the plugin into build/cf7-extended-validation-1.0.0.zip
```

## License

GPL v2 or later — see [LICENSE](LICENSE).
