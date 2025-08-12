import * as esbuild from 'esbuild'
import {sassPlugin} from 'esbuild-sass-plugin'

async function main() {
    await Promise.all([
        esbuild.build({
            entryPoints: ['./js/main.js'],
            bundle     : true,
            minify     : true,
            format     : 'iife',
            outfile    : './public/main.min.js'
        }),
        esbuild.build({
            entryPoints: ['./scss/main.scss'],
            plugins    : [
                sassPlugin({
                    style: 'compressed'
                })
            ],
            bundle     : true,
            minify     : true,
            outfile    : './public/main.min.css'
        })
    ])
}

void main()
