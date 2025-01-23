const path = require("node:path");
const TerserPlugin = require('terser-webpack-plugin');
module.exports = {
    entry: './src/app.js',
    output: {
        // Besoin d'un chemin absolu, path.resolve permet de converir le chemin relatif
        path: path.resolve(__dirname, 'dist'),
        filename: 'bundle-[contenthash].js',
        clean: true,
    },
    devServer: {
        static: path.resolve(__dirname, './dist'),
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        targets: 'defaults',
                        presets: [
                            ['@babel/preset-env']
                        ]
                    }
                }
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            }
        ]
    },
    plugins: [
        new TerserPlugin(),
    ],
    devtool: 'source-map'

}