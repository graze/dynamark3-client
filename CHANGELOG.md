# Change Log

All Notable changes to `dynamark3-client` will be documented in this file

## v2.0.0 - 2016-03-01

### Added
- `connect` method. The client is no longer returned with an active connection upon instantiation
- `CommandSetxml` Command

### Changed
- The static `Dynamark3Client::build` command is now `Dynamark3Client::factory`
- Not all commands' arguments require quoting. Move this functionality to the `Command` itself

### Fixed
- SETXML command will now work

### Deprecated
- Nothing

### Removed
- `Dynamark3Client::build`

### Security
- Nothing

## v1.0.0 - 2016-02-17

### Added
- Everything

### Changed
- Everything

### Fixed
- Nothing

### Deprecated
- Nothing

### Removed
- Nothing

### Security
- Nothing
