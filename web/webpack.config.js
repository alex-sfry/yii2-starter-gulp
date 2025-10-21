import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

export default {
    mode: 'production',
    entry: {
        main: './src/js/main.js',
        bootstrap: './src/js/bootstrap.js',
    },
    output: {
        filename: '[name].min.js',
    },
    resolve: {
        extensions: ['.js']
    },
    devtool: 'source-map',
    plugins: [
    ],
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: { presets: ['@babel/preset-env'] }
                }
            },
        ],
    },
    performance: {
        maxEntrypointSize: 1024000,
        maxAssetSize: 1024000
    }
};