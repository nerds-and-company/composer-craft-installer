# Composer Craft Installer

[Composer installer](https://getcomposer.org/doc/articles/custom-installers.md) 
that helps install [Craft](https://craftcms.com/). (Craft repository not 
included, please provide your own).

## Introduction

As a company we create a lot of websites with Craft. Instead of having to 
manually download and install Craft each time, we have a private repository 
(with some extra magic added). This repository contains a plugin for Composer 
that installs that repository for any project that might need it.

This also makes it easier to install a copy of Craft on build/ci engines (like 
Jenkins or Travis-CI) to have an environment to run test against for custom 
plugins.

## Usage

For this plugin to work, three things are needed:
    
 - a Craft repository 
 - Entries in the Craft repository's `composer.json`
 - An entry in a project's §composer.json§ that requires the Craft repository

### Craft repository

Craft is not open-sourced and requires a license to use in a production. Please 
respect the Craft license an [acquire a legitimate copy](https://craftcms.com/pricing) 
to work with. You can keep that code in a private repository for development 
purposes, as long as you don't share the code-base publicly.

### Craft Repository Composer entry

Once a Craft repository has been made available, make sure it has a valid 
`composer.json` file. For this installer to be used, the `type` entry has to be 
set to `craft-library` and the `nerds-and-company/composer-craft-installer` 
package needs to be `require`'d.

A minimal case would be:

    {
        "name": "acme-corp/craft",
        "description": "Acme Corp. Craft Repository",
        "license": "proprietary",
        "type": "craft-library",
        "require": {
            "nerds-and-company/composer-craft-installer": "~0.1"
        }
    }
    
### Project Composer entry

All that is left now, is to require the Craft repository from a specific project's
`composer.json`:

    {
        "name": "acme-corp/my-craft-based-project",
        "description": "Another Acme Corp. Production",
        "license": "proprietary",
        "require": {
            "acme-corp/craft": "~2.5"
        }
    }

